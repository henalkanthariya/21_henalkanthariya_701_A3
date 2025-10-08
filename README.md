# PHP Shopping Cart (Sample Project)
Defaults:
- DB: shopping_cart
- Admin: admin / admin123
- Uploads folder: uploads/
- Frontend: Bootstrap (simple)

Folders:
- public/           -> web accessible (index.php, assets)
- admin/            -> admin pages (login, manage categories/products)
- includes/         -> db config, helpers
- api/              -> sample PHP REST endpoints
- xml_scripts/      -> students xml import/export
- express_example/  -> Node/Express sample to call PHP API

How to run:
1. Place project in your web server docroot (e.g., XAMPP `htdocs`).
2. Create MySQL database `shopping_cart` and import `sql/shopping_cart.sql`.
3. Ensure `uploads/` is writable.
4. Start Node express example: `cd express_example && npm install && node server.js`

