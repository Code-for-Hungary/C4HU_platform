<?php 
if (!isset($popupYesNo)) {
    $popupYesNo = 0;
}
if (!isset($popupYesDanger)) {
    $popupYesDanger = 0;
}
?>
<div id="popup">
        <div class="modal-container">
            <div class="modal-header">
                <button type="button" class="close" onclick="$('#popup').hide(); ">
                    &times;</button> 
                    <h3 class="modal-title">{{ $popupHeader ?? '' }}</h3>
            </div>
            <div class="modal-body">
                <P id="popupBody">{{ $popupBody ?? '' }}</P>
                <p id="popupButtons">
                @if ($popupYesNo == 1) 
                    <a href="{{ $popupYesUrl ?? '' }}" class="btn btn-primary">{{ __('yes') }}</a>&nbsp;
                    <a href="{{ $popupNoUrl ?? ''}}" class="btn btn-secondary">{{ __('no') }}</a>
                @else    
                    @if ($popupYesDanger == 1) 
                        <a href="{{ $popupYesUrl ?? ''}}" class="btn btn-danger">{{ __('yes') }}</a>&nbsp;
                        <a href="{{ $popupNoUrl ?? ''}}" class="btn btn-secondary">{{ __('no') }}</a>
                    @else 
                        <button type="button" class="btn btn-danger" onclick="$('#popup').hide();">
                        {{ __('ok') }}</button>
                    @endif
                @endif    
                </p>
            </div>
        </div>
</div>
