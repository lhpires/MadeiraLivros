<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function rents()
    {
        $rents = Rent::query()->with(['user','book'])->get();

        $content = "";

        if($rents->count() > 0){
            foreach($rents as $rent)
            {
                // dump($rent);
                $content .= "Nome usuário {$rent->user->name} | Livro Alugado: {$rent->book->name} | Data Inicio Aluguel: {$rent->dt_rent_start} | Data Fim Aluguel: {$rent->dt_rent_start} \n" . PHP_EOL;
            }

            // Crie o cabeçalho da resposta para o download
            $headers = [
                'Content-Type' => 'text/plain',
                'Content-Disposition' => "attachment; filename=relatorio.txt",
            ];
        
            // Crie a resposta com o conteúdo do relatório e os       
            return Response::make($content, 200, $headers);
        }else{
            return back()->withErrors([
                "erro" => "Nenhum Aluguel a ser exportado"
            ]);
        }

     
     
        
    }
}
