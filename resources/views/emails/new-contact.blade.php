<div>
  <h3>Here are the details</h3>
  <p>Are you a musician? <b>{{$data['is_musician']}}</b></p>
  <p>Do you have a debit card? <b>{{$data['have_debit_card']}}</b></p>
  <p>Instagram @Name <b>{{'@'.$data['instagram']}}</b></p>
  <p>Email <b>{{$data['email']}}</b></p>
  <p>
    Instagram Link
    <a href="https://www.instagram.com/{{$data['instagram']}}">
      https://www.instagram.com/{{$data['instagram']}}
    </a>
  </p>
</div>
