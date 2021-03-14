<?php
session_start();
$username = $_GET["username"];


if ($username == null || $username == "") {
  $username = "username";
}

#sa can check who is admin and pass the name to you, just give for admin page

?>


<!DOCTYPE html>
<html>

<head>
  <title>Online Shop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {


      function hash() {

        var page = window.location.hash;
        if (page == "") page = "#";
      }
      hash();

      function detailItem(item, pid) {

        html = '<div class="col-md-3">';
        html += '<img src="photos/' + $(item).find("photo").text() + '"class="w-100 p-3 h-100" alt="Image"></div>';
        html += '<div class="col-md-5">';
        html += '<h1>' + $(item).find("name").text() + '</h1>';
        html += '<p>Color: ' + $(item).find("color").text() + '</p>';
        html += '<p>Description: ' + $(item).find("description").text() + '</p>';
        html += '<p>Origin: ' + $(item).find("origin").text() + '</p>';
        html += '<p>Price: $HKD ' + $(item).find("price").text() + '</p>';
        html += '</div>';

        html += '<div class="col-md-2">';
        html += '<form id="addCart" method="get" action="send cart.php" >'; //method="get" action=""
        html += '<div class="form-group">';
        html += '<label>SELECT SIZE</label>';
        html += '<select class="form-control" name="size" required>';
        html += '<option value="S">S</option>';
        html += '<option value="M">M</option>';
        html += '<option value="L">L</option>';
        html += '</select>';
        html += '</div>';
        html += '<div class="form-group">';
        html += '<label>QUANTITY</label>';
        html += '<input type="number" required name="quantity" id="quantity2bag" required class="form-control" placeholder="Enter Number" value="1" min="1" max="10">';
        html += '</div>';

        html += '<input type="hidden" name="pid" id="pid2bag" value="' + pid + '">';
        html += '<input type="hidden" name="name" id="name2bag" value="' + $(item).find("name").text() + '">';
        html += '<input type="hidden" name="photoAddress" id="photoAddress2bag" value="' + $(item).find("photo").text() + '">';
        html += '<input type="hidden" name="price" id="price2bag" value="' + $(item).find("price").text() + '">';

        html += '<button type="submit" class="btn btn-dark" id="add2bagbtn">ADD TO BAG</button>';
        html += '</form>';
        html += '</div>';
        return html;
      }

      function queryString() {

        var query = window.location.search.substring(1);

        var vars = query.split("&");
        var pair;
        for (var i = 0; i < vars.length; i++) {
          pair = vars[i].split("=");
        }

        if (query != "") {
          $.get("showItemList.php", query, function(data) {
              var html = '<div class ="row" style="padding-top:6vh">';
              $(data).find("top").each(function(j, top) {
                if ($(top).attr("pid") == pair[1]) {
                  html += detailItem(top, pair[1]);
                }
              })
              $(data).find("pant").each(function(j, pant) {
                if ($(pant).attr("pid") == pair[1]) {
                  html += detailItem(pant, pair[1]);
                }
              })
              html += '</div>';
              $("#listContent").html(html);
            })
            .fail(function() {
              alert("Failed.");
            })
        }
      }

      queryString();

      function showEachItem(item) {

        temphtml = '<div class="card col-md-3">';
        temphtml += '<a class="testg" style="text-decoration:none;color:black" href="' + window.location.protocol + "//" + window.location.host + window.location.pathname + '?goitem=' + item.getAttribute('pid') + '">';
        temphtml += '<div class="panel panel-default">';
        temphtml += '<div class="panel-body">';
        temphtml += '<div class="image"><img src="photos/' + $(item).find("photo").text() + '"class="w-100 p-3 h-100" alt="Image"></div>';
        temphtml += '</div>';
        temphtml += '<div class="name">' + $(item).find("name").text() + '</div>';
        temphtml += '<div class="name">' + 'HKD$ ' + $(item).find("price").text() + '</div>';
        temphtml += '</div>';
        temphtml += '</div>';

        return temphtml;
      }

      $("#homebtn").on("click", function() {
        var url = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.location = url;
        return false;
      });

      $("#search").on("click", function() {
        var query = "s=" + $("#serachTxt").val();
        var html = '<div class ="row">';
        $.get("search.php", query, function(data) {
            $(data).find("tops").each(function(i, tops) {
              $(tops).find("top").each(function(j, top) {
                html += showEachItem(top);
              })
            })
            $(data).find("pants").each(function(i, pants) {
              $(pants).find("pant").each(function(j, pant) {
                html += showEachItem(pant);
              })
            })
            html += '</div>';
            hash();
            $("#listContent").html(html);
          })
          .fail(function() {
            alert("Failed.");
          })
      })

      $("#idMenAll").on("click", function() {
        var html = '<div class ="row">';
        var query = "menall=Y";
        $.get("showItemList.php", query, function(data) {
            $(data).find("tops").each(function(i, tops) {
              $(tops).find("top").each(function(j, top) {
                html += showEachItem(top);
              })
            })
            $(data).find("pants").each(function(i, pants) {
              $(pants).find("pant").each(function(j, pant) {
                html += showEachItem(pant);
              })
            })
            html += '</div>';
            $("#listContent").html(html);
          })
          .fail(function() {
            alert("Failed.");
          })
      })

      $("#idMenTop").on("click", function() {
        var html = '<div class ="row">';
        var query = "mentop=Y";
        $.get("showItemList.php", query, function(data) {
            console.log(data);
            $(data).find("tops").each(function(i, tops) {
              $(tops).find("top").each(function(j, top) {
                html += showEachItem(top);
              })
              html += '</div>';
              $("#listContent").html(html);
            })
          })
          .fail(function() {
            alert("Failed.");
          })
      })

      $("#idMenPants").on("click", function() {
        var html = '<div class ="row">';
        var query = "menpants=Y";
        $.get("showItemList.php", query, function(data) {
            $(data).find("pants").each(function(i, pants) {
              $(pants).find("pant").each(function(j, pant) {
                html += showEachItem(pant);
              })
              html += '</div>';
              $("#listContent").html(html);
            })
          })
          .fail(function() {
            alert("Failed.");
          })
      })

      $("#idWomenAll").on("click", function() {
        var html = '<div class ="row">';
        var query = "womenall=Y";
        $.get("showItemList.php", query, function(data) {
            $(data).find("tops").each(function(i, tops) {
              $(tops).find("top").each(function(j, top) {
                html += showEachItem(top);
              })
            })
            $(data).find("pants").each(function(i, pants) {
              $(pants).find("pant").each(function(j, pant) {
                html += showEachItem(pant);
              })
            })
            html += '</div>';
            $("#listContent").html(html);
          })
          .fail(function() {
            alert("Failed.");
          })
      })
      $("#idWomenTop").on("click", function() {
        var html = '<div class ="row">';
        var query = "womentop=Y";
        $.get("showItemList.php", query, function(data) {
            $(data).find("tops").each(function(i, tops) {
              $(tops).find("top").each(function(j, top) {
                html += showEachItem(top);
              })
              html += '</div>';
              $("#listContent").html(html);
            })

          })
          .fail(function() {
            alert("Failed.");
          })
      })
      $("#idWomenPants").on("click", function() {
        var html = '<div class ="row">';
        var query = "womenpants=Y";
        $.get("showItemList.php", query, function(data) {
            $(data).find("pants").each(function(i, pants) {
              $(pants).find("pant").each(function(j, pant) {
                html += showEachItem(pant);
                html += '</div>';
              })
              html += '</div>';
              $("#listContent").html(html);
            })
          })
          .fail(function() {
            alert("Failed.");
          })
      })

    });
  </script>
  <style>
    #cartBtn {
      background-color: transparent;
      border: 1px solid white;
      border-radius: 5px;
      color: white;
      padding: 6px 12px;
      font-size: 16px;
      cursor: pointer;
      margin-left: 0.6vw;
    }

    #cartBtn:hover {
      background-color: white;
      color: black;
    }

    .card {
      margin-top: 1vh;
      margin-right: 1vw;

    }

    .card:hover {
      box-shadow: 0px 2px 4px 0 rgba(0, 0, 0, 0.6);
    }

    .panel-body {
      height: 400px;
      overflow: hidden;
    }
  </style>
</head>

<body>
  <!--navbar here -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <span class="navbar-brand">ABC SHOP</span>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" id="homebtn">Home <span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Men
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#MenAll" id="idMenAll">All</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#MenTop" id="idMenTop">Top</a>
              <a class="dropdown-item" href="#MenPants" id="idMenPants">Pants</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Women
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#WomenAll" id="idWomenAll">All</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#WomenTop" id="idWomenTop">Top</a>
              <a class="dropdown-item" href="#WomenPants" id="idWomenPants">Pants</a>

            </div>
          </li>
        </ul>

        <div class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="serachTxt" name="s">
          <button class="btn btn-secondary" type="button" id="search">Search</button>
        </div>

        <a href="cart.php" style="text-decoration:none;color:black"><button class="btn" id="cartBtn"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button></a>

        <div class="dropdown" style="padding-left:0.5vw">
          <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg class="bi bi-person" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 00.014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 00.022.004zm9.974.056v-.002.002zM8 7a2 2 0 100-4 2 2 0 000 4zm3-2a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd" />
            </svg>

          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item"><?php echo $username; ?></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="index.php">Logout</a>

          </div>
        </div>
      </div>
    </div>
  </nav> <!-- This is the div for showing the item list -->
  <div id="listContent" class="container">
    <h1 style="text-align:center;padding-top:25vh">Welcome to ABC Shop</h1>
  </div>

</body>

</html>