@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create</div>

                <div class="panel-body">
                    <form method="POST" action="/teams">

                      {{ csrf_field() }}

                      <h3>School Info</h3>

                      <div class="row">

                        <div class="col-lg-6">  
                     
                          <div class="form-group">
                            <label for="school_name">School Name</label>
                            <input type="text" class="form-control" id="school_name" name="school_name">
                          </div>

                        </div><!--  Col  -->

                        <div class="col-lg-6">
                     
                          <div class="form-group">
                            <label for="mascot">Mascot</label>
                            <input type="text" class="form-control" id="mascot" name="mascot">
                          </div>

                        </div><!--  Col  -->

                    </div><!--  Row  -->

                    <h3>Location</h3>

                    <div class="row">

                        <div class="col-lg-6"> 

                          <div class="form-group">
                            <label for="state">State</label>
                              <select name="state" id="state" class="form-control">
                                <option value="">Select A State</option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District Of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                               </select>
                          </div>

                        </div><!--  Col  -->

                        <div class="col-lg-6">

                          <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city">
                          </div>

                        </div><!--  Col  -->

                    </div><!--  Row  -->

                    <h3>Baseball Info</h3>

                    <div class="row">

                        <div class="col-lg-6"> 

                          <div class="form-group">
                            <label for="region_baseball">Region</label>
                              <select name="region_baseball" id="region_baseball" class="form-control">
                                <option value="">Select An Option</option>
                                    @for ($x = 1; $x < 17; $x++)
                                        <option value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                        </div><!--  Col  -->

                        <div class="col-lg-6"> 

                          <div class="form-group">
                            <label for="district_baseball">District</label>
                              <select name="district_baseball" id="district_baseball" class="form-control">
                                <option value="">Select An Option</option>
                                    @for ($x = 1; $x < 65; $x++)
                                        <option value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                        </div><!--  Col  -->

                    </div><!--  Row  -->

                    <h3>Basketball Info</h3>

                    <div class="row">

                        <div class="col-lg-6"> 

                          <div class="form-group">
                            <label for="region_basketball">Region</label>
                              <select name="region_basketball" id="region_basketball" class="form-control">
                                <option value="">Select An Option</option>
                                    @for ($x = 1; $x < 17; $x++)
                                        <option value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                        </div><!--  Col  -->

                        <div class="col-lg-6"> 

                          <div class="form-group">
                            <label for="district_basketball">District</label>
                              <select name="district_basketball" id="district_basketball" class="form-control">
                                <option value="">Select An Option</option>
                                    @for ($x = 1; $x < 65; $x++)
                                        <option value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                        </div><!--  Col  -->

                    </div><!--  Row  -->

                    <h3>Football Info</h3>

                    <div class="row">

                        <div class="col-lg-6"> 

                          <div class="form-group">
                            <label for="region_football">Region</label>
                              <select name="region_football" id="region_football" class="form-control">
                                <option value="">Select An Option</option>
                                    @for ($x = 1; $x < 17; $x++)
                                        <option value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                        </div><!--  Col  -->

                        <div class="col-lg-6"> 

                          <div class="form-group">
                            <label for="district_football">District</label>
                              <select name="district_football" id="district_football" class="form-control">
                                <option value="">Select An Option</option>
                                    @for ($x = 1; $x < 65; $x++)
                                        <option value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                        </div><!--  Col  -->

                    </div><!--  Row  -->

                    <h3>Soccer Info</h3>

                    <div class="row">

                        <div class="col-lg-6"> 

                          <div class="form-group">
                            <label for="region_soccer">Region</label>
                              <select name="region_soccer" id="region_soccer" class="form-control">
                                <option value="">Select An Option</option>
                                    @for ($x = 1; $x < 17; $x++)
                                        <option value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                        </div><!--  Col  -->

                        <div class="col-lg-6"> 

                          <div class="form-group">
                            <label for="district_soccer">District</label>
                              <select name="district_soccer" id="district_soccer" class="form-control">
                                <option value="">Select An Option</option>
                                    @for ($x = 1; $x < 65; $x++)
                                        <option value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                        </div><!--  Col  -->

                    </div><!--  Row  -->

                    <h3>Volleyball Info</h3>

                    <div class="row">

                        <div class="col-lg-6"> 

                          <div class="form-group">
                            <label for="region_volleyball">Region</label>
                              <select name="region_volleyball" id="region_volleyball" class="form-control">
                                <option value="">Select An Option</option>
                                    @for ($x = 1; $x < 17; $x++)
                                        <option value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                        </div><!--  Col  -->

                        <div class="col-lg-6"> 

                          <div class="form-group">
                            <label for="district_volleyball">District</label>
                              <select name="district_volleyball" id="district_volleyball" class="form-control">
                                <option value="">Select An Option</option>
                                    @for ($x = 1; $x < 65; $x++)
                                        <option value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                        </div><!--  Col  -->

                    </div><!--  Row  -->

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Publish</button>
                      </div>


                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
