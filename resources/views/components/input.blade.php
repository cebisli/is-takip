<div class="form-group {{$topclass}}">
    <label for="{{$id}}" class="form-control-label px-3">{{$label}} 
        @if($required)
            <span class="text-danger"> *</span> 
        @endif    
    </label>
    <input type="{{$type}}" class="{{$inputclass}} form-control @error($name) is-invalid @enderror" 
    id="{{$id}}" name="{{$name}}" placeholder="{{$placeholder}}" 
    @if(!is_null($step))
    step="{{$step}}"
    @endif
    @if(!is_null($max))
    max="{{$max}}"
    @endif
    @if(!is_null($maxlength))
    maxlength="{{$maxlength}}"
    @endif
    @if(!is_null($pattern))
    pattern="{{$pattern}}"
    @endif
    value="{{$value}}" 
    @if(!is_null($validate))
    onblur="inputValidate(this)"
    @endif
    {{($required) ? 'required' : '' }} 
    {{($disabled) ? 'disabled' : '' }}>

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>