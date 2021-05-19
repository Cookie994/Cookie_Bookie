<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">  <title>Cookie Bookie</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <br>
    <h3 align="center">Cookie Bookie</h3>
    <button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs mb-3" data-bs-toggle="modal" data-bs-target="#recipeModal">Add New Recipe</button>
    <div class="row"></div>
    </div>
  </div>
  <!-- Modal for create form-->
  <div class="modal fade" id="recipeModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Recipe</h5>
        </div>
        <form id="createRecipe" name="createRecipe" role="form">
          <div class="modal-body">
            <div class="form-group">
                <label>Name</label>
                <input id="name" type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label>Ingredients</label>
                <input id="ingredients" type="text" name="ingredients" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label>Time</label>
                <input id="time" type="text" name="time" class="form-control">
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category" id="category" class="form-select"></select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="button_action" class="btn btn-info">Create</button>
          </div>
        </form>
        
      </div>
    </div>
  </div>

  <!-- Modal for update form -->
  <div class="modal fade" id="updateModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Recipe</h5>
        </div>
        <form id="updateRecipe" name="updateRecipe" role="form">
          <div class="modal-body">
            <div class="form-group">
                  <label>Name</label>
                  <input id="uname" type="text" name="uname" class="form-control">
              </div>
              <div class="form-group">
                  <label>Ingredients</label>
                  <input id="uingredients" type="text" name="uingredients" class="form-control" placeholder="">
              </div>
              <div class="form-group">
                  <label>Time</label>
                  <input id="utime" type="text" name="utime" class="form-control">
              </div>
              <div class="form-group">
                  <label>Category</label>
                  <select name="ucategory" id="category" class="form-select"></select>
              </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id" class="id" id="">  
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
        
      </div>
    </div>
  </div>

  <script type="text/javascript">

    
    $(document).ready(function(){

      // $("#add_button").click(function(){
      //   $('#button_action').val('Create');
      //   $('.modal-title').text('Create Recipe');
      //   $('#createRecipe')[0].reset();
      // });
      
      //read recipes
        $.getJSON("api/recipe/read.php", function(result){
          var output = '';
          $.each(result, function(key, val){
            output += '' +
                    '<div class="col-sm-3 border border-info rounded bg-light m-2 p-2">' +
                      '<h4>' + val.recipe_name + '</h4>' +
                      '<p>' + val.ingredients + '</p>' +
                       '<p>Category: ' + val.category_name + '</p>' +
                      '<button type="button" name="edit" class="btn btn-warning me-2 edit" id="' + val.id + '" data-bs-toggle="modal" data-bs-target="#updateModal">Edit</button>' +
                      '<button type="button" name="delete" class="btn btn-danger delete" id="' + val.id + '">Delete</button>' +
                    '</div>';
          });
          $(".row").html(output);
          
          //read one recipe and update
          $(".edit").click(function(){
            // $('#button_action').val('Update');
            // $('.modal-title').text('Update Recipe');
            // $("#recipeModal").modal("show");
            var id = $(this).attr("id");
            $(".id").val(id);

                  
                  
          });
          
        });

        $("#updateRecipe").submit(function(event){
                event.preventDefault();
                var serializedData = $("#updateRecipe").serialize();
                $.post("api/recipe/update.php", serializedData);
                alert("Recipe Updated");
                $("#updateModal").modal('hide');
              });
      //read categories and output them in modal
      $.getJSON("api/categories/read.php", function(result){
        var output = '';
        $.each(result, function(key, val){
          output += '' +
                    '<option value="' + val.id + '">' + val.name + '</option>'
        });
        $("#category").html(output);
      });

      //Create recipes
      $("#createRecipe").submit(function(event){
        event.preventDefault();
        $.post("api/recipe/create.php", $("form").serialize());
        alert("Recipe created");
        $("#recipeModal").modal('hide');
      });
          
     });
  </script>
</body>
</html>



