<?php

namespace App\Http\Controllers;

use App\Models\testModel;
use Illuminate\Http\Request;

class testPost extends Controller
{
    public function handlePost(Request $request)
    {
        $token = $request->header('Authorization');

        if ($this->isValidToken($token)) {
            $response = $this->sendDataToExternalAPI($request->all());

            if ($response->status() == 200) {
                testModel::create($request->all());

                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false], $response->status());
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    private function isValidToken($token)
    {
        if (!empty($token)) {
            return true;
        } else {
            return false;
        }
    }

    private function sendDataToExternalAPI($data)
    {
        return response()->json(['message' => 'Data sent to external API successfully'], 200);
    }
}
