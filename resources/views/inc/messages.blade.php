@if(session('success'))
    
<div class="modal fade" id="myModal" role="dialog" aria-hidden="true" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3>{{session('success')}}</h3>
            </div>
        </div>
    </div>
</div>

@endif

