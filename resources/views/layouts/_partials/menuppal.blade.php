<div class="menuppal" style="margin: 5px; padding: 5px; display: flex;flex-direction: column;">
    <br><br><br>

<div class="card">
    <div class="card-body">
        <ul>
            <li>
                <a href="{{ route('index') }}">Index</a>
    
            </li>
    
            <li><a href="{{route('employeesindex')}}">Listado de {{ __('Employees') }}</a></li>
            <li><a href="{{ route('admin.employees.index') }}">Administrar {{ __('Employees') }}</a></li>
        </ul>
    </div>
</div>
</div>
