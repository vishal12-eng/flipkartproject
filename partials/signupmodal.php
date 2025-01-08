

<!-- Modal -->
<div class="modal fade" id="signupmodal" tabindex="-1" aria-labelledby="signupmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupmodalLabel">signup to your iDiscuss Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form  action="partials/handlesignup.php" method="post">

      <div class="modal-body">

   
  <div class="mb-3">
    <label for="signupemail" class="form-label">Username</label>
    <input type="text" class="form-control" id="signupEmail" name="signupemail" aria-describedby="emailHelp">


  </div>
  <div class="mb-3">
    <label for="signupPassword" class="form-label">Password</label>
    <input type="password" class="form-control" id="signupPassword" name="signupPassword">
  </div>
  <div class="mb-3">
    <label for="signupcPassword" class="form-label">confirm Password</label>
    <input type="password" class="form-control" id="signupcPassword" name="signupcPassword">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>