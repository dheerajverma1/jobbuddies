<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Log;

trait ZoomMeetingTrait
{
    public $client;
    public $jwt;
    public $headers;

    public function __construct()
    {
        $this->client = new Client();
        $this->jwt = $this->generateZoomToken();
        Log::info('Generated JWT token: Bearer ' . $this->jwt);
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->jwt,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function generateZoomToken()
    {
        $key = env('ZOOM_API_KEY', '');
        $secret = env('ZOOM_API_SECRET', '');

        if (empty($key) || empty($secret)) {
            Log::error('Zoom API key or secret is not set.');
            return null;
        }

        $expirationTime = time() + 3600;

        $payload = [
            'iss' => $key,
            'exp' => $expirationTime,
        ];

        try {
            return JWT::encode($payload, $secret, 'HS256');
        } catch (\Exception $e) {
            Log::error('Error encoding JWT: ' . $e->getMessage());
            return null;
        }
    }

    private function retrieveZoomUrl()
    {
        return env('ZOOM_API_URL', 'https://api.zoom.us/v2/');
    }

    public function toZoomTimeFormat(string $dateTime)
    {
        try {
            $date = \DateTime::createFromFormat('d/m/Y H:i', $dateTime);

            return $date->format('Y-m-d\TH:i:s');
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : ' . $e->getMessage());

            return '';
        }
    }

    public function create($data)
    {
        $path = 'users/me/meetings';
        $url = $this->retrieveZoomUrl();
        $body = [
            'headers' => $this->headers,
            'body' => json_encode([
                'topic' => $data['topic'],
                'type' => self::MEETING_TYPE_SCHEDULE,
                'start_time' => $this->toZoomTimeFormat($data['start_time']),
                'duration' => $data['duration'],
                'agenda' => (!empty($data['agenda'])) ? $data['agenda'] : null,
                'timezone' => 'Asia/Kolkata',
                'settings' => [
                    'host_video' => true,
                    'participant_video' => true,
                    'waiting_room' => true,
                ],
            ]),
        ];

        try {
            $response = $this->client->post($url . $path, $body);
            return [
                'success' => $response->getStatusCode() === 201,
                'data' => json_decode($response->getBody(), true),
            ];
        } catch (\Exception $e) {
            Log::error('Error creating Zoom meeting: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function updateMeeting($id, $data)
    {
        $path = 'meetings/' . $id;
        $url = $this->retrieveZoomUrl();

        $body = [
            'headers' => $this->headers,
            'body' => json_encode([
                'topic' => $data['topic'],
                'type' => self::MEETING_TYPE_SCHEDULE,
                'start_time' => $this->toZoomTimeFormat($data['start_time']),
                'duration' => $data['duration'],
                'agenda' => (!empty($data['agenda'])) ? $data['agenda'] : null,
                'timezone' => 'Asia/Kolkata',
                'settings' => [
                    'host_video' => true,
                    'participant_video' => true,
                    'waiting_room' => true,
                ],
            ]),
        ];

        try {
            $response = $this->client->patch($url . $path, $body);
            return [
                'success' => $response->getStatusCode() === 204,
                'data' => json_decode($response->getBody(), true),
            ];
        } catch (\Exception $e) {
            Log::error('Error updating Zoom meeting: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function get($id)
    {
        $path = 'meetings/' . $id;
        $url = $this->retrieveZoomUrl();

        $body = [
            'headers' => $this->headers,
        ];

        try {
            $response = $this->client->get($url . $path, $body);
            return [
                'success' => $response->getStatusCode() === 200,
                'data' => json_decode($response->getBody(), true),
            ];
        } catch (\Exception $e) {
            Log::error('Error retrieving Zoom meeting: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function delete($id)
    {
        $path = 'meetings/' . $id;
        $url = $this->retrieveZoomUrl();

        $body = [
            'headers' => $this->headers,
        ];

        try {
            $response = $this->client->delete($url . $path, $body);
            return [
                'success' => $response->getStatusCode() === 204,
            ];
        } catch (\Exception $e) {
            Log::error('Error deleting Zoom meeting: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}

