<?php

namespace App\Http\Controllers;

use App\Mail\MailSendController;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    //cette fonction permet de recuperer et d'enregistrer en bd un message du formulaire et de l'envoyer a l'administrateur du site
    public function storeMessage(Request $request){

        //verification et validation de donnees de formulaire
        $dataRegister = $request->all();
        $msg = htmlspecialchars($dataRegister['message']);
        if(empty($dataRegister)){

            return response()->json([

                "stataus" => "echec",
                "message" => "veuillez remplir correctement l'ensemble du formulaire d'envoi"

            ]);
        }

        $validators = Validator::make($dataRegister, [

            "nom" => "required|string|max:255",
            "email" => "required|string",
            "sujet"=>"required|string",
            "message"=>"required|string"
        ]);

        if($validators->fails()){

            return response()->json([

                "status" => "echec",
                "message" => $validators->errors()
            ]);
        }

        //envoie du mail de l'utilisateur a l'admin avec une adresse statique
        Mail::to("contact@netappli.com")->send(new MailSendController($msg));

        $createMessage = Email::create($dataRegister);

        return response()->json([

            "status"=>"success",
            "message"=>'votre message a bien e envoyer a notre equipe'
        ]);

    }
}