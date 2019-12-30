<div class="row">
<div class="col-md-4">

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Ticket Generate</h3>
              </div>
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <?= form_open('crn/add_crn_process',array("class"=>"form-vertical")) ?>
<div class="form-group">
  <label for="name" class="col-md-4 control-label"><span class="text-danger">*</span>Name</label>
  <div class="col-md-4">
    <input type="text" name="name" value="<?php echo $this->input->post('parent_Name'); ?>" class="form-control" id="name" required  autofocus onfocusout="validationNasName();"/>
    <span class="text-danger name_error"></span>
  </div>
</div>


<div class="form-group">
  <label for="nas_id" class=" control-label"><span class="text-danger">*</span>Mobile Number</label>
  <div class="col-md-4">
    <input type="text" name="mobile" value="<?php echo $this->input->post('nas_id'); ?>" class="form-control" id="nas_id" onfocusout="validationNas();" />
    <span class="text-danger nas_error"></span>
  </div>
</div>


<div class="form-group">
  <label for="location" class="col-md-4 control-label"><span class="text-danger">*</span>Location</label>
  <div class="col-md-8" id="locationField">
    <input type="text" name="location" value="<?php echo $this->input->post('location'); ?>" class="form-control"  onfocusout="ip();" data-toggle="tooltip" data-placement="top" title="ex- 192.168.0.1" id="autocomplete" placeholder="e.g. SV Road, Bandra West, Mumbai" onFocus="geolocate()"/>
    <span class="text-danger ip_error"> </span>
  </div>
</div>
<div class="form-group">
  <label for="description" class="col-md-4 control-label"><span class="text-danger">*</span>Description</label>
  <div class="col-md-8">
    <input type="text" name="description" value="<?php echo $this->input->post('description'); ?>" class="form-control" id="description" onfocusout="ip();" data-toggle="tooltip" data-placement="top" title=""/>
    <span class="text-danger ip_error"> </span>
  </div>
</div>
<div class="form-group">
  <label for="remark" class="col-md-4 control-label"><span class="text-danger">*</span>Remarks</label>
  <div class="col-md-8">
    <input type="text" name="remarks" value="<?php echo $this->input->post('ip_address'); ?>" class="form-control" id="ip_address" onfocusout="ip();" data-toggle="tooltip" data-placement="top" title="ex- 192.168.0.1"/>
    <span class="text-danger ip_error"> </span>
  </div>
</div>
<div class="form-group">
  <label for="remark" class="col-md-4 control-label"><span class="text-danger">*</span>lead</label>
  <div class="col-md-8">
    <select class="form-control" name="lead">

      <option value="">select</option>
      <option value="1">broadband</option>
      <option value="2">cctv</option>
      <option value="3">software</option>
      <option value="4">other</option>
      
    </select>
  </div>
</div>
<div class="form-group">
  <label for="remark" class="col-md-4 control-label"><span class="text-danger">*</span>Type</label>
  <div class="col-md-8">
    <select class="form-control" name="type">
      <option value="1">customer</option>
      <option value="2">frenchise</option>
      <option value="3">reseller</option>
      
    </select>
  </div>
</div>



  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-5">
                        <button type="submit" class="btn btn-success"  onclick="submitForm('<?= base_url() ?>enquiry/add')">Generate new ticket</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-5">
                        <button type="submit" class="btn btn-success"  onclick="submitForm('<?= base_url() ?>enquiry/existing_add')">Update Existing ticket</button>
                    </div>
                </div>
  <?= form_close(); ?>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name',
      };

      

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        
        console.log(place.geometry.location.lat());
        console.log(place.geometry.location.lng());

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        document.getElementById('lat').value = place.geometry.location.lat().toString();
        document.getElementById('lng').value = place.geometry.location.lng().toString();

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwBQKHT1VzQEI4EE0YHUOEUhYcOqutJX4&libraries=places&callback=initAutocomplete"
        async defer></script>
