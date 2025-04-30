<?php

Flight::route("GET /applications", function() {
    Flight::json(Flight::application_service()->get_all());
}); 

Flight::route("GET /applications/@id", function($id) {
    Flight::json(Flight::application_service()->getByApplicationId($id));
}); 

Flight::route("DELETE /applications/@id", function($id) {
    Flight::application_service()->delete($id);
    Flight::json(['message' => "Application added successfully"]);
});

Flight::route("POST /applications", function() {
    $request = Flight::request()->data->getData();
    Flight::json([
        'message' => "Application added successfully",
        'data' => Flight::application_service()->add($request)
    ]);
});

Flight::route("PATCH /applications/@id", function($id) {
    $application = Flight::request()->data->getData();
    Flight::json([
        'message' => "Application eddited successfully",
        'data' => Flight::application_service()->update($application, $id, 'id')
    ]);
});

