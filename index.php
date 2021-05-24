<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">  <title>Cookie Bookie</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style/style.css">
</head>
<body>
  <header class="p-3 mb-3 shadow">
    <div class="container">
      <div class="d-flex align-items-center">
        <h2 class="me-auto mt-2">Cookie Bookie</h2>
        <button type="button" name="add_button" id="add_button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#recipeModal">Add New Recipe</button>
      </div>
    </div>
  </header>
  <section>
  <div class="container" id="headImg">
      <form id="searchbox" autocomplete="off">
        <input type="search" class="form-control shadow" id="search" placeholder="Search recipe">
      </form>
      <img src="style/img/header_img.jpg" class="img-fluid rounded" alt="food">
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row d-flex justify-content-center mt-2 mt-md-4"></div>
    </div>
  </section>
  <!-- Modal for insert form-->
  <div class="modal fade" id="recipeModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Recipe</h5>
        </div>
        <form id="createRecipe" name="createRecipe" role="form" autocomplete="off">
          <div class="modal-body d-grid gap-2">
            <div class="form-group">
                <label>Name</label>
                <input id="name" type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label>Ingredients</label>
                <input id="ingredients" type="text" name="ingredients" class="form-control">
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
            <input type="hidden" name="id" id="id">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            <input type="submit" id="button_action" class="btn btn-outline-success" value="Create">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">

    
    $(document).ready(function(){

      //search for specific name/category
      $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".row #recipe").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });

      //show hidden recipes
      $("#search").keyup(function(e){
        if(e.keyCode == 8){
          $(".row #recipe").show();
        }
      });

      //reset modal for create
      $("#add_button").click(function(){
        $('#button_action').val('Create');
        $('.modal-title').text('Create Recipe');
        $('#createRecipe')[0].reset();
      });
      
      //read recipes
      $.getJSON("api/recipe/read.php", function(result){
        var output = '';
        $.each(result, function(key, val){
          output += '' +
                  '<div class="col-7 col-sm-5 col-lg-3 rounded m-2 p-2 text-center shadow" id="recipe">' +
                    '<h4>' + val.recipe_name + '</h4>' +
                    '<p>' + val.ingredients + '</p>' +
                    '<p>Category: ' + val.category_name + '</p>' +
                    '<p>Time: ' + val.time + '</p>' +
                    '<button type="button" name="edit" class="btn btn-outline-warning me-2 btn-sm edit" id="' + val.id + '">Edit</button>' +
                    '<button type="button" name="delete" class="btn btn-outline-danger btn-sm delete" id="' + val.id + '">Delete</button>' +
                  '</div>';
        });
        $(".row").html(output);
        
        //read one recipe
        $(".edit").click(function(){
          $('#button_action').val('Update');
          $('.modal-title').text('Update Recipe');
          $("#recipeModal").modal("show");
          var id = $(this).attr("id");
          $("#id").val(id);
          $.getJSON("api/recipe/read_single.php", {id}, function(result){
            $("#name").val(result.recipe_name);
            $("#ingredients").val(result.ingredients);
            $("#time").val(result.time);
            $("#category option[value='" + result.category_id + "']").attr('selected', 'selected');
          });      
        });

        //delete recipe
        $(".delete").click(function(){
          var id = $(this).attr("id");
          if(confirm("Delete this recipe?")){
            $.post("api/recipe/delete.php", {id:id});
          }
        });

        //refresh page after inserting/updating data or deleting
        $("#button_action, .delete").click(function(){
          location.reload(true);
        });
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

      //Create or update recipes
      $("#createRecipe").submit(function(event){
        event.preventDefault();
        $.post("api/recipe/insert.php", $("#createRecipe").serialize());
        if($("#button_action").val() == 'Update'){
          alert("Recipe updated");
        } else {
          alert("Recipe created");
        }
        $("#recipeModal").modal('hide');
      });

     });
  </script>
</body>
</html>



