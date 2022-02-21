<form action="/contact" method="POST">

  @csrf

  <div class="mb-6">
    <p style="color: #f4311e; max-width:100%; font-size:21px;" class="mb-4">
        <strong>Are you a musician?</strong>
    </p>

    <label>
        <input type="radio" name="is_musician" value="Yes" required="required" />  Yes
    </label>
    <br/>
    <label>
        <input type="radio" name="is_musician" value="No" required="required" />  No
    </label>
  </div>

  <div class="mb-6">
    <p style="color: #f4311e; max-width:100%; font-size:21px;" class="mb-4">
      <strong>Do you have a debit card?</strong>
    </p>

    <label>
      <input type="radio" name="have_debit_card" value="Yes" required="required" />  Yes
    </label>
    <br/>
    <label>
      <input type="radio" name="have_debit_card" value="No I Don't Have One" required="required" />  No I Don't Have One
    </label>
    <br/>
    <label>
      <input type="radio" name="have_debit_card" value="I Have Cash But No Card" required="required" />  I Have Cash But No Card
    </label>
  </div>

  <div class="mb-6">
    <p style="color: #f4311e; max-width:100%; font-size:21px;" class="mb-4">
      <strong>Instagram @ Name :</strong>
    </p>

    <div class="flex flex-row">
      <span class="inline text-2xl">@</span>
      <span class="inline">
          <input type="text" name="instagram" id="name" onkeyup="validateName()" required="required" class="shadow appearance-none border rounded w-full py-2 pr-3 text-lg text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      </span>
    </div>
    <div id="name-error" style="color: red; font-weight: bolder;"></div>

    <script>
      function validateName() {
          var name = document.getElementById('name').value
          console.log('name => ', name);

          if (name.indexOf(' ') !== -1) {
            document.getElementById('name-error').innerText = 'Please type in one word with no spaces'
            document.getElementById('submit-button').disabled = true
          } else {
            if (name === '') {
              document.getElementById('name-error').innerText = ''
            } else {
              document.getElementById('name-error').innerText = 'Please double check you have spelled correctly'
            }
            document.getElementById('submit-button').disabled = false
          }
      }
    </script>
  </div>

  <div class="mb-6 w-full md:w-4/12">
    <p style="color: #f4311e; max-width:100%; font-size:21px;" class="mb-4">
      <strong>Email:</strong>
    </p>

    <div class="flex flex-row">
        <input type="email" name="email" id="email" required="required" class="shadow appearance-none border rounded w-full py-2 pr-3 text-lg text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
  </div>

  <div class="form_input" style="width: 58%;">
    <span class="form_input" style="width: 58%;">
      <input type="submit" name="submit" id="submit-button" value="Sign Up" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded w-full cursor-pointer" />
    </span>
  </div>
</form>
