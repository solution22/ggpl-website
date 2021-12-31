      
      @include('emails.header')

        <div id="child_content1">
          <h2>New Enquiry</h2>
          <hr>
          <p class="child_msg">Hi, {{ setting('app_name') }}, New contact enquiry received from {{$details['name']}}.</p>
          <table cellpadding="6" class="child_msg1">
            <tr>
              <td style="width:40%"><b>Name: </b></td>
              <td style="width:60%"><b>{{ $details['name'] }}</b></td>
            </tr> 
            <tr>
              <td style="width:40%"><b>Mobile: </b></td>
              <td style="width:60%"><b>{{ $details['mobile_no'] }}</b></td>
            </tr>
            <tr>
              <td style="width:40%"><b>Email: </b></td>
              <td style="width:60%"><b>{{ $details['email'] }}</b></td>
            </tr>
            <tr>
              <td style="width:40%"><b>Message: </b></td>
              <td style="width:60%"><b>{{ $details['message'] }}</b></td>
            </tr>
            
          </table>
        </div>

      @include('emails.footer')

