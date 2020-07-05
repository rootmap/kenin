<div class="imputs-wrap w-hidden-main w-hidden-medium">
    <div class="imput-wrap">
        <label for="Check-in" class="field-label">Arrival Date</label>
        <input type="text" class="imput w-input" autocomplete="off" maxlength="256" name="Check-in" data-name="Check-in" placeholder="Arrival Date" id="datetimepicker3" required="">
        {{-- <input type="text" class="imput w-input" maxlength="256" name="Check-in" id="datetimepicker"/> --}}
    </div>
</div>
<div class="imputs-wrap w-hidden-main w-hidden-medium">
    <div class="imput-wrap">
        <label for="Check-out"  class="field-label">Departure Date</label>
        <input type="text" class="imput w-input" autocomplete="off"  maxlength="256" name="Check-out" data-name="Check-out" placeholder="Departure Date" id="datetimepicker4" required="">
    </div>
</div>
<div class="imputs-wrap w-hidden-main w-hidden-medium">
    <div class="imput-wrap">
        <label for="Guests" class="field-label">Adults</label>
        {{-- <input type="text" class="imput w-input" maxlength="256" name="Guests" data-name="Guests" placeholder="3 Persons" id="guests" required=""> --}}
        <select class="imput w-select">
            @for ($i = 1; $i <10; $i++)
                <option value="{{$i}}">{{$i}} Adults</option>
            @endfor
        </select>
    </div>
</div>
<div class="imputs-wrap w-hidden-main w-hidden-medium">
    <div class="imput-wrap">
        <label for="Guests" class="field-label">Children</label>
        {{-- <input type="text" class="imput w-input" maxlength="256" name="Guests" data-name="Guests" placeholder="3 Persons" id="guests" required=""> --}}
        <select class="imput w-select">
            @for ($i = 0; $i <6; $i++)
                <option value="{{$i}}">{{$i}} Children</option>
            @endfor
        </select>
    </div>
</div>