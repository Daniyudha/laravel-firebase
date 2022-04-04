<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;
use Carbon\Carbon;

class FirebaseController extends Controller
{
    protected $auth, $database;

    public function __construct()
    {
        $factory = (new Factory)
        ->withServiceAccount(__DIR__.'/config-esp32-firebase.json')
        ->withDatabaseUri('https://esp32-project-trial-default-rtdb.asia-southeast1.firebasedatabase.app/');

        $this->auth = $factory->createAuth();
        $this->database = $factory->createDatabase();
    }

    public function signUp()
    {
        $email = "angelicdemon@gmail.com";
        $pass = "anya123";

        try {
            $newUser = $this->auth->createUserWithEmailAndPassword($email, $pass);
            dd($newUser);
        } catch (\Throwable $e) {
            switch ($e->getMessage()) {
                case 'The email address is already in use by another account.':
                    dd("Email sudah digunakan.");
                    break;
                case 'A password must be a string with at least 6 characters.':
                    dd("Kata sandi minimal 6 karakter.");
                    break;
                default:
                    dd($e->getMessage());
                    break;
            }
        }
    }

    public function signIn()
    {
        $email = "angelicdemon@gmail.com";
        $pass = "anya123";

        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($email, $pass);
            // dump($signInResult->data());

            Session::put('firebaseUserId', $signInResult->firebaseUserId());
            Session::put('idToken', $signInResult->idToken());
            Session::save();

            dd($signInResult);
        } catch (\Throwable $e) {
            switch ($e->getMessage()) {
                case 'INVALID_PASSWORD':
                    dd("Kata sandi salah!.");
                    break;
                case 'EMAIL_NOT_FOUND':
                    dd("Email tidak ditemukan.");
                    break;
                default:
                    dd($e->getMessage());
                    break;
            }
        }
    }

    public function signOut()
    {
        if (Session::has('firebaseUserId') && Session::has('idToken')) {
            // dd("User masih login.");
            $this->auth->revokeRefreshTokens(Session::get('firebaseUserId'));
            Session::forget('firebaseUserId');
            Session::forget('idToken');
            Session::save();
            dd("User berhasil logout.");
        } else {
            dd("User belum login.");
        }
    }

    public function userCheck()
    {
        // $idToken = "";

        // $this->auth->revokeRefreshTokens("");

        // if (Session::has('firebaseUserId') && Session::has('idToken')) {
        //     dd("User masih login.");
        // } else {
        //     dd("User sudah logout.");
        // }

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($idToken, $checkIfRevoked = true);
            dump($verifiedIdToken);
            dump($verifiedIdToken->claims()->get('sub')); // uid
            dump($this->auth->getUser($verifiedIdToken->claims()->get('sub')));
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }

        // try {
        //     $verifiedIdToken = $this->auth->verifyIdToken(Session::get('idToken'), $checkIfRevoked = true);
        //     $response = "valid";
        //     // dd("Valid");
        //     // $uid = $verifiedIdToken->getClaim('sub');
        //     // $user = $auth->getUser($uid);
        //     // dump($uid);
        //     // dump($user);
        // } catch (\InvalidArgumentException $e) {
        //     // dd('The token could not be parsed: '.$e->getMessage());
        //     $response = "The token could not be parsed: " . $e->getMessage();
        // } catch (InvalidToken $e) {
        //     // dd('The token is invalid: '.$e->getMessage());
        //     $response = "The token is invalid: " . $e->getMessage();
        // } catch (RevokedIdToken $e) {
        //     $response = "revoked";
        // } catch (\Throwable $e) {
        //     if (substr(
        //         $e->getMessage(),
        //         0,
        //         21
        //     ) == "This token is expired") {
        //         $response = "expired";
        //     } else {
        //         $response = "something_wrong";
        //     }
        // }
        // return $response;
    }

    public function read()
    {
        // dd($this->database->getReference('Office')->getValue());
        $data = [
			'title' => 'Control Station',
            "temperature" => $this->database->getReference('Monitoring')->getValue()['Temperature'],
            "humadity" => $this->database->getReference('Monitoring')->getValue()['Humidity'],
            "lampu1" => $this->database->getReference('Control')->getValue()['relay1'],
            "dateserver" => $this->database->getReference('Monitoring')->getValue()['TIMESTAMP'],
            "log" => $this->database->getReference('log')->orderByChild("TIMESTAMP")->limitToLast('20')->getValue()
		];

        $total_temperature = [];
        $count_temperature = 0;
        $total_humidity = [];
        foreach($data['log'] as $key => $value){
            $total_temperature[] = $value['Temperature'];
            // $count_temperature = count($value);
            $total_humidity[] = $value['Humidity'];
        }
        $data["min_temperature"] =  min($total_temperature);
        $data["max_temperature"] = max($total_temperature);
        $data["avg_temperature"] = array_sum($total_temperature)/count($total_temperature);

        $data["min_humidity"] =  min($total_humidity);
        $data["max_humidity"] = max($total_humidity);
        $data["avg_humidity"] = array_sum($total_humidity)/count($total_humidity);

        // dd($data);
        return response()->json($data);
    }

    public function update()
    {
        // before
        $ref = $this->database->getReference('Office')->getValue();
        // dump($ref);

        // update data
        $ref = $this->database->getReference('Office')
        ->update([
            "relay1" => "0"
            // "Lampu 1" => [
            //     "status" => "1",
            // ],
            // "Lampu 2" => [
            //     "status" => "0",
            // ]
        ]);

        // after
        $ref = $this->database->getReference('Office')->getValue();
        dump($ref);
    }

    public function set(Request $request)
    {
        // before
        // dd($request->data);
        $ref = $this->database->getReference('Control')->getValue();
        // dump($ref);

        // set data
        $ref = $this->database->getReference('Control')
        ->set([
            "relay1" => $request->data
            // "Control/relay1" => [
            //     "status" => $request->data,
            // ],
            // "Lampu 2" => [
            //     "status" => "1",
            // ]
        ]);

        // after
        $ref = $this->database->getReference('Control')->getValue();
        return json_encode($ref);
    }
    
    public function delete()
    {
        // before
        $ref = $this->database->getReference('hewan/karnivora/harimau')->getValue();
        dump($ref);

        /**
         * 1. remove()
         * 2. set(null)
         * 3. update(["key" => null])
         */

        // remove()
        $ref = $this->database->getReference('hewan/karnivora/harimau/benggala')->remove();

        // set(null)
        $ref = $this->database->getReference('hewan/karnivora/harimau/benggala')
            ->set(null);

        // update(["key" => null])
        $ref = $this->database->getReference('hewan/karnivora/harimau')
            ->update(["benggala" => null]);

        // after
        $ref = $this->database->getReference('hewan/karnivora/harimau')->getValue();
        dump($ref);
    }
        
}