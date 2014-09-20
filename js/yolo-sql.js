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
    
    $('#create-schema').click(function() {
        $('#createSchemaModal').open();
    });
    
    // Private functions
    var
    process_data = function(data) {
        console.log(data);
        
        var status = data.status,
            type = data.type,
            content = data.content;
        
        // Remove previous content
        $('#output-section').html();
        
        if (!status) {
            $('#output-section').html('<p>' + content + '</p>');
        } else {
            if (type === 'r') {
                if (content.length > 0) {
                    var pivot = content[0],
                        columns = [];
                    
                    // Store column names
                    for (column in pivot) {
                        columns.push(column);
                    }
                    
                    // Build HTML for table
                    $('#output-section').append(table_html);
                    $('#output-table').html(get_columns_html(columns) + get_rows_html(content));
                } else {
                    // Empty set
                }
            } else if (type === 'w') {
                $('#output-section').html('<p>Affected rows: ' + content + '</p>');
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
    
    yolo_sql.execute_on_cursor = function() {
        var cursor = editor.getCursor(),
                    content = editor.getLine(cursor.line);
                    
        $.post(site_url + 'index.php/home/execute_statements', {'content': content}, process_data);
    };
    
    yolo_sql.execute_selected = function() {
        var content = editor.getSelection();
                
        $.post(site_url + 'index.php/home/execute_statements', {'content': content}, process_data);
    };
})(window.yolo_sql = window.yolo_sql || {}, jQuery);