<br>
<!-- Nav tabs -->
<ul id="tabs" class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#sql-editor" role="tab" data-toggle="tab">SQL Editor</a></li>
    <li><a href="#create-table" role="tab" data-toggle="tab">Create table</a></li>
    <li><a href="#er-diagram" role="tab" data-toggle="tab">ER diagram</a></li>
</ul>

<div class="tab-content">
    
    <!-- SQL EDITOR TAB -->
    <div class="tab-pane active" id="sql-editor">
        <div class="row">
            <div class="col-lg-12">
                <div class="dropdown btn-group">
                    <button class="btn btn-sm btn-default dropdown-toggle" type="button" id="templatesDropDownMenu" data-toggle="dropdown">
                        Templates
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="templatesDropDownMenu">
                        <li role="presentation"><a id="select-statement" role="menuitem" tabindex="-1" href="#">Select statement</a></li>
                        <li role="presentation"><a id="insert-statement" role="menuitem" tabindex="-1" href="#">Insert statement</a></li>
                        <li role="presentation"><a id="update-statement" role="menuitem" tabindex="-1" href="#">Update statement</a></li>
                        <li role="presentation"><a id="delete-statement" role="menuitem" tabindex="-1" href="#">Delete statement</a></li>
                    </ul>
                    <button id="execute-on-cursor" class="btn btn-sm btn-primary">Execute on cursor</button>
                    <button id="execute-selected" class="btn btn-sm btn-primary">Execute selected</button>
                    <button id="save-sql-file" class="btn btn-sm btn-primary">Save SQL file</button>
                </div>
                <hr>
                <textarea id="code"></textarea>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div id="output">
                    <h2 class="page-header">Output</h2>
                    <div id="output-section"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- CREATE TABLE TAB -->
    <div class="tab-pane" id="create-table">
        <div hidden id="create-table-success-alert" class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            Table created <strong>successfully</strong>. Refresh to see changes.
        </div>
        <div hidden id="create-table-error-alert" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        
        <div class="form-inline">
            <div class="form-group">
                <label class="sr-only">Schema name</label>
                <input type="text" id="create-table-schema-name" class="form-control" placeholder="Enter schema name">
            </div>
            <div class="form-group">
                <label class="sr-only">Table name</label>
                <input type="text" id="create-table-table-name" class="form-control" placeholder="Enter table name">
            </div>
            <div class="form-group">
                <label class="sr-only">Engine type</label>
                <select id="create-table-engine" class="form-control">
                    <option value="InnoDB">-- ENGINE TYPE --</option>
                    <option>MyISAM</option>
                    <option>CSV</option>
                    <option>MEMORY</option>
                    <option>BLACKHOLE</option>
                    <option>FEDERATED</option>
                    <option>MRG_MYISAM</option>
                    <option>ARCHIVE</option>
                    <option>InnoDB</option>
                    <option>PERFORMANCE_SCHEMA</option>
                </select>
            </div>
        </div>
        <hr>
        <table class="table table-striped table-bordered">
            <thead>
                <td>Field name</td>
                <td>Type</td>
                <td>PK</td>
                <td>NN</td>
                <td>AI</td>
                <td>Default</td>
                <td></td>
            </thead>
            <tbody id="create-table-cols">
                <tr>
                    <td><input data-field="name" type="text" class="form-control"></td>
                    <td><input data-field="type" type="text" class="form-control"></td>
                    <td><input data-field="pk" type="checkbox"></td>
                    <td><input data-field="nn" type="checkbox"></td>
                    <td><input data-field="ai" type="checkbox"></td>
                    <td><input data-field="default" type="text" class="form-control"></td>
                    <td><button class="create-table-delete-field btn btn-xs btn-danger">&Cross;</button></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-group">
            <button id="create-table-add-field" class="btn btn-default">Add field</button>
            <button id="create-table-apply" class="btn btn-primary">Apply changes</button>
        </div>
    </div>
    
    <!-- ER DIAGRAM TAB -->
    <div class="tab-pane" id="er-diagram">
        
    </div>
</div>