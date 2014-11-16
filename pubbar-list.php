<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CheapestBeer</title>

    <!-- css -->
    <link href="assets/css/main.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <main>
      <header>
        <form class="form-default" action="">
          <select>
            <option value="">Dublin, Ireland</option>
          </select>
          <section class="calendar">
            <p><strong>Saturday</strong></p> <a class="btn-calendar" href="#"></a>
          </section>
        </form>
        <h1><a href="#" title="Cheapest Beer"><span>cheapestBeer</span></a></h1>
        <form class="search" action="">
          <input type="text" placeholder="Search">
          <a class="btn-menu" href="#">menu</a>
        </form>
      </header>

      <section class="container">
        <article>
          <table class="list">
            <thead>
              <tr>
                <th>Pub/Bar</th>
                <th>Beer</th>
                <th>Price</th>
                <th>Atmosphere</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Diceys</td>
                <td>Corona</td>
                <td>€2,50</td>
                <td class="rating">
                  <input type="hidden" class="rating" data-filled="symbol symbol-filled" data-empty="symbol symbol-empty"/> 
                </td>
                <td class="result-rating"></td>
              </tr>
            </tbody>
          </table>
        </article>
      </section>
    </main>



    <script type="text/javascript" src="http://dreyescat.github.io/bootstrap-rating/bower_components/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="http://dreyescat.github.io/bootstrap-rating/bootstrap-rating.js"></script>
    <script>
      var a = $('input.check').on('change', function () {
        alert('Rating: ' + $(this).val());
      });
    </script>
  </body>
</html>