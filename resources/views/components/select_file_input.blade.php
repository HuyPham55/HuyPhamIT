<div class="input-group">
    <input id="{{ $keyId }}"
           class="form-control"
           type="text"
           name="{{$inputName}}"
           @if(isset($disabled))
               {{$disabled ? 'disabled' : ''}}
           @endif
           value="{{$inputValue}}">
    <span class="input-group-btn input-group-append">
             <?php
             $fileTypes = array_keys(config('lfm.folder_categories'));
             ?>
             <a data-input="{{ $keyId }}"
                data-preview="image-preview-{{ $keyId }}"
                @if(isset($disabled))
                    {{$disabled ? 'disabled' : ''}}
                @endif
                class="btn btn-primary lfm-{{in_array($lfmType, $fileTypes)?$lfmType:$fileTypes[0]}}">
                 <i class="fa fa-folder-open"></i>
             </a>
             <button onclick="resetInput('{{ $keyId }}')"
                     class="btn btn-outline-danger"
                     @if(isset($disabled))
                         {{$disabled ? 'disabled' : ''}}
                     @endif
                     type="button">
                 <i class="fas fa-eraser"></i>
             </button>
         </span>
</div>






