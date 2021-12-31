      
      @include('emails.header')

        <div id="child_content1">
          <h2>{{$details['title']}}</h2>
          <hr>
          <p class="child_msg">Hi, {{ setting('app_name') }}, New Volunteer Subscription received from {{$details['name']}}.</p>
          <table cellpadding="6" class="child_msg1">
            <tr>
              <td style="width:40%"><b>Name: </b></td>
              <td style="width:60%"><b>{{ $details['name'] }}</b></td>
            </tr> 
            <tr>
              <td style="width:40%"><b>Gender: </b></td>
              <td style="width:60%"><b>{{ $details['gender'] }}</b></td>
            </tr>
            <tr>
              <td style="width:40%"><b>Date of Birth: </b></td>
              <td style="width:60%"><b>{{ $details['date_of_birth'] }}</b></td>
            </tr>
            <tr>
              <td style="width:40%"><b>Email: </b></td>
              <td style="width:60%"><b>{{ $details['email'] }}</b></td>
            </tr>
            <tr>
              <td style="width:40%"><b>Mobile No: </b></td>
              <td style="width:60%"><b>{{ $details['mobile_no'] }}</b></td>
            </tr>
            <tr>
              <td style="width:40%"><b>Address Line 1: </b></td>
              <td style="width:60%"><b>{{ $details['address_line_1'] }}</b></td>
            </tr>
            <tr>
              <td style="width:40%"><b>Address Line 2: </b></td>
              <td style="width:60%"><b>{{ $details['address_line_2'] }}</b></td>
            </tr>
            <tr>
              <td style="width:40%"><b>City: </b></td>
              <td style="width:60%"><b>{{ $details['city'] }}</b></td>
            </tr>
            <tr>
              <td style="width:40%"><b>State: </b></td>
              <td style="width:60%"><b>{{ $details['state'] }}</b></td>
            </tr>
            <tr>
              <td style="width:40%"><b>Pincode: </b></td>
              <td style="width:60%"><b>{{ $details['pincode'] }}</b></td>
            </tr>
            
            
          </table>
        </div>

      @include('emails.footer')

