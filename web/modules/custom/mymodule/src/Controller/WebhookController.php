<?php

namespace Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class WebhookController extends ControllerBase {

  /**
   * Handle incoming webhook.
   */
  public function handle(Request $request): JsonResponse {

    // 1️⃣ Get raw payload (important for signature validation)
    $payload = $request->getContent();

    // 2️⃣ Get headers
    $signature = $request->headers->get('X-Signature');

    // 3️⃣ Validate signature (security)
    $secret = 'my_webhook_secret';
    $expectedSignature = hash_hmac('sha256', $payload, $secret);

    if (!$signature || !hash_equals($expectedSignature, $signature)) {
      return new JsonResponse([
        'status' => 'error',
        'message' => 'Invalid signature',
      ], Response::HTTP_UNAUTHORIZED);
    }

    // 4️⃣ Decode JSON safely
    $data = json_decode($payload, TRUE);

    if (json_last_error() !== JSON_ERROR_NONE) {
      return new JsonResponse([
        'status' => 'error',
        'message' => 'Invalid JSON payload',
      ], Response::HTTP_BAD_REQUEST);
    }

    // 5️⃣ Idempotency check (VERY IMPORTANT)
    if (!empty($data['event_id'])) {
      $state = \Drupal::state();
      if ($state->get('webhook_processed_' . $data['event_id'])) {
        return new JsonResponse([
          'status' => 'ignored',
          'message' => 'Event already processed',
        ], Response::HTTP_OK);
      }
      $state->set('webhook_processed_' . $data['event_id'], TRUE);
    }

    // 6️⃣ Process webhook event
    switch ($data['event_type'] ?? '') {
      case 'payment.success':
        // Handle success logic
        \Drupal::logger('mymodule')->info('Payment successful: @id', [
          '@id' => $data['event_id'] ?? 'N/A',
        ]);
        break;

      case 'payment.failed':
        \Drupal::logger('mymodule')->warning('Payment failed');
        break;

      default:
        \Drupal::logger('mymodule')->notice('Unhandled webhook event');
    }

    // 7️⃣ Always return 200 for successful receipt
    return new JsonResponse([
      'status' => 'success',
    ], Response::HTTP_OK);
  }

}