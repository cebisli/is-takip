<div class="form-group {{$topclass}}">
    <label class="form-control-label px-3" for="{{$id}}">{{$label}}
        @if($required)
            <span class="text-danger"> *</span> 
        @endif
    </label>
    <select class="form-control {{$inputclass}} @error($name) is-invalid @enderror" 
        id="{{$id}}" name="{{$name}}" style="width:100%" 
        @if(!is_null($validate))
            onblur='inputValidate(this)'
        @endif
        @if(!is_null($onchange))
            onchange="{{$onchange}}"
        @endif 
        {{($required) ? 'required' : '' }} 
        {{($disabled) ? 'disabled' : '' }}
        {{($multiple) ? 'multiple' : '' }}>
        {{$slot}}        
    </select>
    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>