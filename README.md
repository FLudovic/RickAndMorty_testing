### Hello It's me Morty

Frontend test : ![example workflow](https://github.com/FLudovic/RickAndMorty_testing/actions/workflows/frontend.yml/badge.svg?branch=master&event=push)

<html>
  <body>
    <script src="badge.js"></script>
    <script>
      var myBadge = new badge.Boolean({
        text: 'Frontend',
        status: true,
        statusText: 'success !'
      });

      document.body.appendChild(myBadge.asDOMNode());
    </script>
  </body>
</html>

Cypress test : ![example workflow](https://github.com/FLudovic/RickAndMorty_testing/actions/workflows/frontend-cypress.yml/badge.svg?branch=master&event=push)

<html>
  <body>
    <script src="badge.js"></script>
    <script>
      var myBadge = new badge.Boolean({
        text: 'Frontend Cypress',
        status: true,
        statusText: 'success !'
      });

      document.body.appendChild(myBadge.asDOMNode());
    </script>
  </body>
</html>

Backend test : ![example workflow](https://github.com/FLudovic/RickAndMorty_testing/actions/workflows/backend.yml/badge.svg?branch=master&event=push)

<html>
  <body>
    <script src="badge.js"></script>
    <script>
      var myBadge = new badge.Boolean({
        text: 'Backend',
        status: true,
        statusText: 'success !'
      });

      document.body.appendChild(myBadge.asDOMNode());
    </script>
  </body>
</html>