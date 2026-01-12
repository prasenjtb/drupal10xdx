<?php

namespace Drupal\rest_apis\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provides a custom REST resource.
 *
 * @RestResource(
 *   id = "custom_resource",
 *   label = @Translation("Custom Resource"),
 *   uri_paths = {
 *     "canonical" = "/api/custom-data/{id}",
 *     "create" = "/api/custom-data",
 *     "delete" = "/api/custom-data/{id}"
 *   }
 * )
 */
class CustomResource extends ResourceBase {

    /**
     * Responds to GET requests.
     *
     * @return \Drupal\rest\ResourceResponse
     *   The HTTP response.
     */
    public function get() {
        // Implement your logic to fetch data here.
        $data = ['message' => 'Hello from custom API!', 'timestamp' => time()];
        return new ResourceResponse($data);
    }

    /**
     * Responds to POST requests.
     *
     * @param array $data
     *   The request data.
     *
     * @return \Drupal\rest\ResourceResponse
     *   The HTTP response.
     */
    public function post(array $data) {
        // Implement your logic to process posted data here.
        // Example: Save data to a custom table or entity.
        $response_data = ['status' => 'success', 'received_data' => $data];
        return new ResourceResponse($response_data, 201); // 201 Created
    }

    /*public function post(Request $request) {
        $data = json_decode($request->getContent());
        $response = ['message' => 'Hello, this is a POST rest service from GUiNZ!', 'received_data' => $data];
        return new ResourceResponse($response);
    }*/

    /**
   * Responds to entity DELETE requests.
   *
   * @param string $id
     *   The request ID.
     *
     * @return \Drupal\rest\ResourceResponse
     *   The HTTP response.
   */
  public function delete(string $id) {

    $response_data = ['status' => 'deleted', 'received_id' => $id];
    // DELETE responses have an empty body.
    return new ResourceResponse($response_data, 204);

    /*try {
      //$entity->delete();
      //$this->logger->notice('Deleted entity %type with ID %id.', ['%type' => $entity->getEntityTypeId(), '%id' => $entity->id()]);

      $response_data = ['status' => 'success', 'received_data' => $data];
      // DELETE responses have an empty body.
      return new ModifiedResourceResponse($response_data, 204);
    }
    catch (EntityStorageException $e) {
      throw new HttpException(500, 'Internal Server Error', $e);
    }*/
  }
}