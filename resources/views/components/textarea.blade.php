<div class="form-group {{$topclass}}">
    <label class="form-control-label px-3">{{$label}}
        @if($required)
            <span class="text-danger"> *</span> 
        @endif
    </label>
    <textarea class="form-control {{$inputclass}} @error($name) is-invalid @enderror" 
    rows="{{$rows}}" id="{{$id}}" name="{{$name}}" 
    @if(!is_null($placeholder))
        placeholder="{{$placeholder}}"
    @endif
    @if(!is_null($validate))
        onblur="inputValidate(this)"
    @endif 
    {{($required) ? 'required' : '' }}
    {{($disabled) ? 'disabled' : '' }}
    >{{$slot}}</textarea>
    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>