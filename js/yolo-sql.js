;(function (yolo_sql, $, undefined) {
    
    // Private variables
    var site_url = '',
        editor = CodeMirror.fromTextArea(document.getElementById('code'), {
                mode: 'text/x-mysql',
                indentWithTabs: true,
                smartIndent: true,
                lineNumbers: true,
                matchBrackets : true,
                autofocus: true,
                extraKeys: {"Ctrl-Space": "autocomplete"},
        }),
        table_html = '<table id="output-table" class="table table-condensed table-bordered table-hover"></table>';
        
    // Public variables
    yolo_sql.VERSION = '';
    yolo_sql.AUTHORS = ['Ossama Edbali'];
    
    // Bind events
    $('#select-statement').click(function() {
        editor.setValue("SELECT * FROM tbl_name;");
    });
    
    $('#insert-statement').click(function() {
        editor.setValue("INSERT INTO tbl_name (some_column) VALUES (some_value);");
    });
    
    $('#update-statement').click(function() {
        editor.setValue("UPDATE tbl_name SET column1=value1 WHERE some_column=some_value;");
    });
    
    $('#delete-statement').click(function() {
        editor.setValue("DELETE FROM tbl_name WHERE some_column=some_value;");
    });
    
    // Private functions
    var
    process_data = function(data) {
        console.log(data);
        
        var status = data.status,
            type = data.type,
            content = data.content;
        
        // Remove previous content
        $('#output-section').html('');
        
        if (!status) {
            $('#output-section').html('<div class="alert alert-danger" role="alert"><strong>Error!</strong> ' + content + '</div>');
        } else {
            if (type === 'r') {
                if (content.length > 0) {
                    var pivot = content[0],
                        columns = [];
                    
                    // Store column names
                    for (var column in pivot) {
                        if (typeof pivot !== 'function' && pivot.hasOwnProperty(column))
                            columns.push(column);
                    }
                    
                    // Build HTML for table
                    $('#output-section').append(table_html);
                    $('#output-table').html(get_columns_html(columns) + get_rows_html(content));
                } else {
                    // Empty set
                    $('#output-section').append('<div class="alert alert-success" role="alert"><strong>Empty set</strong> returned. Please insert some rows.</div>');
                }
            } else if (type === 'w') {
                $('#output-section').html('<div class="alert alert-success" role="alert">Affected rows: <strong>' + content + '</strong></div>');
            }
        }
    },
    
    get_columns_html = function(columns) {
        var html = '<thead>',
            clen = columns.length,
            i = 0;
        
        for (i = 0; i < clen; i++) {
            html += '<td>'  + columns[i] + '</td>';
        }
        html += '</thead>';
        
        return html;
    },
    
    get_rows_html = function(content) {
        var html = '<tbody>',
            clen = content.length,
            i;
    
        for (i = 0; i < clen; i++) {
            html += '<tr>';
            for (column in content[i]) {
                html += '<td>' + content[i][column] + '</td>';
            }
            html += '</tr>';
        }
        
        return html;
    };
    
    // Public API
    yolo_sql.set_site_url = function(surl) {
        site_url = surl;
    };
    
    yolo_sql.use_schema = function() {
        $('a.database').removeClass('active');
                
        var db_name = $(this).data('schema'); // Check

        $.post(site_url + 'index.php/home/use_database', {'db_name' : db_name}, function(data) {
            $('#' + data).addClass('active');
        });
    };
    
    yolo_sql.execute = function(query) {
        $.post(site_url + 'index.php/home/execute_statements', {'content': query}, process_data);
    };
    
    yolo_sql.execute_on_cursor = function() {
        var cursor = editor.getCursor(),
                    content = editor.getLine(cursor.line);
        
        if (content === '') {
            return;
        }
        
        $.post(site_url + 'index.php/home/execute_statements', {'content': content}, process_data);
    };
    
    yolo_sql.execute_selected = function() {
        var content = editor.getSelection();
        
        if (content === '') {
            return;
        }
        
        $.post(site_url + 'index.php/home/execute_statements', {'content': content}, process_data);
    };
    
    yolo_sql.create_schema = function(e) {
        e.preventDefault();
        
        var $el = $(this);
        $.post($el.attr('action'), $el.serialize(), function(data) {
            var status = data.status,
                content = data.content;
            
            if (status) {
                location = site_url + 'index.php/home';
            } else {
                $('#output-section').html('<div class="alert alert-danger" role="alert"><strong>Error!</strong> ' + content + '</div>');
            }
            
            // Dismiss modal
            $('#createSchemaModal').modal('hide');
        });
    };
    
    yolo_sql.drop_schema = function(schema) {
        $.post(site_url + 'index.php/home/drop_schema', {'schema': schema}, function(data) {
            var status = data.status,
                content = data.content;
            
            if (status) {
                location = site_url + 'index.php/home';
            } else {
                $('#output-section').html('<div class="alert alert-danger" role="alert"><strong>Error!</strong> ' + content + '</div>');
            }
        });
    };
    
    yolo_sql.add_field = function() {
        var str = 
                '<tr>' +
                    '<td><input data-field="name" type="text" class="form-control"></td>' +
                    '<td><input data-field="type" type="text" class="form-control"></td>' +
                    '<td><input data-field="pk" type="checkbox"></td>' +
                    '<td><input data-field="nn" type="checkbox"></td>' +
                    '<td><input data-field="ai" type="checkbox"></td>' +
                    '<td><input data-field="default" type="text" class="form-control"></td>' +
                    '<td><button class="create-table-delete-field btn btn-xs btn-danger">&Cross;</button></td>' +
                '</tr>';
        
        $('#create-table-cols').append(str);
    };
    
    yolo_sql.add_row = function() {
        var str = '';
        
        $('#insert-rows-table').append(str);
    };
    
    yolo_sql.create_table = function() {
        var db_name = $('#create-table-schema-name').val(),
            table_name = $('#create-table-table-name').val(),
            engine = $('#create-table-engine').val(),
            $rows = $('#create-table-cols').children(),
            sql = 'CREATE TABLE `' + db_name + '`.`' + table_name + '` (';
        
        $('#create-table-success-alert').attr('hidden', '');
        $('#create-table-error-alert').attr('hidden', '');
        $('#create-table-error-alert p').remove();
        
        $rows.each(function() {
            var def = $(this).find('[data-field="default"]').val(),
                pk = $(this).find('[data-field="pk"]').is(':checked'),
                nn = $(this).find('[data-field="nn"]').is(':checked'),
                ai = $(this).find('[data-field="ai"]').is(':checked');
                
            // Insert fields
            sql += $(this).find('[data-field="name"]').val() + ' ';
            sql += $(this).find('[data-field="type"]').val() + ' ';
            
            if (pk) {
                sql += 'PRIMARY KEY ';
            }
            
            if (pk && ai) {
                sql += 'AUTO_INCREMENT ';
            }
            
            sql += (!pk && !ai && !nn) ? 'NULL ' : 'NOT NULL ';
            sql += (def !== '' ? 'DEFAULT ' + "'" + def + "'" : '') + ' ';
            
            sql.trim();
            sql += ',';
        });
        
        // Remove trailing comma
        sql = sql.slice(0, -1);
        
        sql += ') ENGINE = ' + engine;
        $.post(site_url + 'index.php/home/create_table', {'sql': sql}, function(data) {
            var status = data.status,
                content = data.content;
            
            if (status) {
                //location = site_url + 'index.php/home';
                $('#create-table-success-alert').removeAttr('hidden');
            } else {
                $('#create-table-error-alert')
                        .append('<p><strong>Error!</strong> ' + content + '</p>')
                        .removeAttr('hidden');
            }
        });
        
        console.log(sql);
    };
    
    yolo_sql.drop_table = function(table) {
        $.post(site_url + 'index.php/home/drop_table', {'table': table}, function(data) {
            var status = data.status,
                content = data.content;
            
            if (status) {
                location = site_url + 'index.php/home';
            } else {
                $('#output-section').html('<div class="alert alert-danger" role="alert"><strong>Error!</strong> ' + content + '</div>');
            }
        });
    };
    
    yolo_sql.truncate_table = function(table) {
        $.post(site_url + 'index.php/home/truncate_table', {'table': table}, function(data) {
            var status = data.status,
                content = data.content;
            
            if (status) {
                $('#output-section').html('<div class="alert alert-success" role="alert">Table "' + table + '" truncated successfully. Refresh to see changes.</div>');
            } else {
                $('#output-section').html('<div class="alert alert-danger" role="alert"><strong>Error!</strong> ' + content + '</div>');
            }
        });
    };
    
    yolo_sql.save_sql_file = function() {
        var content = editor.getValue();
        
        var newForm = $('<form>', {
                'action': site_url + 'index.php/home/save_sql_file',
                'target': '_top',
                'method': 'post'
            }).append($('<input>', {
                'name': 'content',
                'value': content,
                'type': 'hidden'
            }));
            
        newForm.submit();
    };
    
    yolo_sql.set_insert_rows_form = function(table) {
        $('#insert-rows-body').html('');
        $('#output-table').remove();
        
        $.post(site_url + 'index.php/home/execute_statements', {'content': 'DESCRIBE `' + table + '`'}, function (data) {
            var status = data.status,
                content = data.content;
                
            if (status) {
                var content = data.content,
                    columns = [],
                    body_html = '',
                    i;
                
                for ( i = 0; i < content.length; i += 1 ) {
                    columns[i] = content[i]['Field'];
                }
                
                // Build HTML template for table
                $('#insert-rows-body').append(table_html);
                $('#output-table').html(get_columns_html(columns) + '<tbody></tbody>');
                
                // First row (pivot --> for further usage, cloning)
                body_html += '<tr id="insert-rows-pivot">';
                for ( i = 0; i < columns.length; i += 1 ) {
                    body_html += '<td><input class="form-control" type="text" data-col="' + columns[i] + '" ></td>';
                }
                body_html += '</tr>';
                $('#output-table tbody').append(body_html);
            } else {
                $('#output-section').html('<div class="alert alert-danger" role="alert"><strong>Error!</strong> ' + content + '</div>');
            }
        });
        
        $('#insertRowsModal').modal('show');
    };
    
    yolo_sql.add_row = function() {
        $new_row =  $("#insert-rows-pivot").clone();
        $new_row.removeAttr('id');
        
        $('#output-table tbody').append($new_row);
    };
    
    yolo_sql.insert_apply = function() {
        var html_insert = 'INSERT INTO table_name (...) VALUES ';
        
        $('#output-table tr').each(function() {
            html_insert += '(';
            $(this).find('td input').each(function() {
                html_insert += '"' + $(this).val() + '",';
            });
            html_insert = html_insert.substr(0, html_insert.length - 1); // Remove trailing comma
            html_insert += '),';
        });
        html_insert = html_insert.substr(0, html_insert.length - 1); // Remove trailing comma
        
        // Close and clear modal
        /*$('#insertRowsModal').modal('hide');
        $('#insert-rows-body').html('');*/
        console.log(html_insert);
    };
    
    yolo_sql.parse_er_diagram = function() {
        
    };
    
})(window.yolo_sql = window.yolo_sql || {}, jQuery);