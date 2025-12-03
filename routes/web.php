Router::get("", "HomeController@index");
Router::get("tienda", "ProductosController@tienda");

Router::get("login", "AuthController@login");
Router::post("login", "AuthController@procesarLogin");
Router::get("logout", "AuthController@logout");

Router::get("carrito", "CarritoController@index");
Router::get("carrito/agregar/{id}", "CarritoController@agregar");
Router::post("carrito/actualizar/{id}", "CarritoController@actualizar");
Router::get("carrito/quitar/{id}", "CarritoController@quitar");
Router::get("carrito/vaciar", "CarritoController@vaciar");

Router::get("pedidos/checkout", "PedidosController@checkout");
Router::post("pedidos/procesar", "PedidosController@procesar");
Router::get("pedidos/confirmacion/{id}", "PedidosController@confirmacion");

Router::group("admin", function() {

    Router::groupGet("dashboard", "Admin\\DashboardController@index");

    // Productos
    Router::groupGet("productos", "Admin\\ProductosController@index");
    Router::groupGet("productos/crear", "Admin\\ProductosController@crear");
    Router::groupPost("productos/guardar", "Admin\\ProductosController@guardar");
    Router::groupGet("productos/editar/{id}", "Admin\\ProductosController@editar");
    Router::groupPost("productos/actualizar/{id}", "Admin\\ProductosController@actualizar");
    Router::groupGet("productos/eliminar/{id}", "Admin\\ProductosController@eliminar");

    // Categorías
    Router::groupGet("categorias", "Admin\\CategoriasController@index");
    Router::groupGet("categorias/crear", "Admin\\CategoriasController@crear");
    Router::groupPost("categorias/guardar", "Admin\\CategoriasController@guardar");
    Router::groupGet("categorias/editar/{id}", "Admin\\CategoriasController@editar");
    Router::groupPost("categorias/actualizar/{id}", "Admin\\CategoriasController@actualizar");
    Router::groupGet("categorias/eliminar/{id}", "Admin\\CategoriasController@eliminar");

});
