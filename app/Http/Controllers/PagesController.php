<?php

namespace App\Http\Controllers;

use App\Models\inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PagesController extends Controller
{
    public function log(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        if (!auth()->attempt($request->only('username', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid Login Details');
        } else {
            return redirect()->route('home');
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
    public function download_pdf($id)
    {
        $inquiry = inquiry::find($id);
        $name = $inquiry->id . 'quotation.pdf';
        $pdf = App::make('dompdf.wrapper');
        $pdf->set_paper('legal', 'portrait');
        $pdf->loadView('pages.quotation', array('id' => $id));
        return $pdf->download($name);
    }
    public function sales_pdf($id)
    {
        $inquiry = inquiry::find($id);
        $name = $inquiry->id . 'sales.pdf';
        $pdf = App::make('dompdf.wrapper');
        $pdf->set_paper('legal', 'portrait');
        $pdf->loadView('pages.sales', array('id' => $id));
        return $pdf->download($name);
    }
    public function jopdf($id)
    {
        $inquiry = inquiry::find($id);
        $name = $inquiry->id . 'jo.pdf';
        $pdf = App::make('dompdf.wrapper');
        $pdf->set_paper('legal', 'portrait');
        $pdf->loadView('pages.jopdf', array('id' => $id));
        return $pdf->download($name);
    }
}
