<?php

namespace App\Traits;

trait ApiResponseTrait
{

    
    // Resource was successfully created
    
    protected function createdResponse($data)
    {
        $response = $this->successEnvelope(201, $data, 'Created');

        return response()->json($response, 201);
    }

    
    // Resource was successfully deleted
     
    protected function deletedResponse()
    {
        $response = $this->successEnvelope(204, [], 'Deleted');

        return response()->json($response, 204);
    }

    
    // Returns general error
    
    protected function errorResponse($errors)
    {
        $response = $this->errorEnvelope(400, $errors);

        return response()->json($response, 400);
    }

    
    protected function unauthorizedResponse($errors=[]){
        $response = $this->errorEnvelope(401, $errors, 'Unauthorized');
        return response()->json($response, 401);
    }
    // Client does not have proper permissions to perform action.
     
    protected function insufficientPrivilegesResponse($errors=[])
    {
        $response = $this->errorEnvelope(403, $errors, 'Forbidden');

        return response()->json($response, 403);
    }

    
    // Returns a list of resources

    protected function listResponse($data)
    {
        $response = $this->successEnvelope(200, $data);

        return response()->json($response);
    }


    // Requested resource wasn't found

    protected function notFoundResponse()
    {
        $response = $this->errorEnvelope(404, [], 'Not Found');

        return response()->json($response, 404);
    }

    
    // Return information for single resource
     
    protected function showResponse($data)
    {
        $response = $this->successEnvelope(200, $data);

        return response()->json($response);
    }

    
    // Return error when request is properly formatted, but contains validation errors
    
    protected function validationErrorResponse($errors)
    {
        $response = $this->errorEnvelope(422, $errors, 'Unprocessable Entity');

        return response()->json($response, 422);
    }

    
    //  Standard error envelope structure
    
    private function errorEnvelope(
        $status = 400,
        $errors = [],
        $message = 'Bad Request'
    ) {
        return [
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
        ];
    }

    
    // Standard success envelope structure
 
    private function successEnvelope(
        $status = 200,
        $data = [],
        $message = 'OK'
    ) {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];
    }

}