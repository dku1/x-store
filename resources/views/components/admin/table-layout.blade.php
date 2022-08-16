<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            {{ $cardTitle }}
        </h3>
        <div class="card-tools mt-1">
            {{ $cardTools }}
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <tr>
                {{ $tableHeaders }}
            </tr>
            <tr>
                {{ $tableContent }}
            </tr>
        </table>
    </div>
</div>
