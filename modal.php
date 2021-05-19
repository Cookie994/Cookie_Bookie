<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <button type="button" name="add_button" id="add_button" class="btn btn-success btn mb-3" data-toggle="modal" data-target="#recipeModal">Add New Recipe</button>
    <div class="row">
    </div>
  </div>
  <!-- Modal for create form-->
  <div class="modal fade" id="recipeModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Recipe</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        
          <div class="modal-body">
          <form id="createRecipe" name="createRecipe" role="form">
            <div class="form-group">
                <label>Name</label>
                <input id="name" type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label>Ingredients</label>
                <input id="ingredients" type="text" name="ingredients" class="form-control">
            </div>
            <!-- <div class="form-group">
                <label>Time</label>
                <input id="time" type="time" name="time" class="form-control">
            </div> -->
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id ="submit" class="btn btn-primary">Save changes</button>
          </div>
        
      </div>
    </div>
  </div>
  
</div>

</body>
</html>