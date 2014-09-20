<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Yolo SQL</h1>
    </div>
</div>

<!-- Nav tabs -->
<ul id="tabs" class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#sql-editor" role="tab" data-toggle="tab">SQL Editor</a></li>
    <li><a href="#create-table" role="tab" data-toggle="tab">Create table</a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="sql-editor">
        <div class="row">
            <div class="col-lg-12">
                <div class="btn-group">
                    <button id="execute-on-cursor" class="btn btn-sm btn-default">Execute on cursor</button>
                    <button id="execute-selected" class="btn btn-sm btn-default">Execute selected</button>
                    <button id="select-statement" class="btn btn-sm btn-default">Select statement</button>
                    <button id="insert-statement" class="btn btn-sm btn-default">Insert statement</button>
                    <button id="update-statement" class="btn btn-sm btn-default">Update statement</button>
                    <button id="delete-statement" class="btn btn-sm btn-default">Delete statement</button>
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
                    <td><button class="create-table-delete-field" class="btn btn-xs btn-danger">D</button></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-group">
            <button id="create-table-add-field" class="btn btn-default">Add field</button>
            <button id="create-table-apply" class="btn btn-primary">Apply changes</button>
        </div>
    </div>
</div>