<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\MarketingRepository;
use Repositories\RankRepository;
use Repositories\CountryRepository;
use Repositories\ProvinceRepository;
use Repositories\DistrictRepository;

class MarketingController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(MarketingRepository $marketingRepo, RankRepository $rankRepo, CountryRepository $countryRepo, ProvinceRepository $provinceRepo, DistrictRepository $districtRepo) {
        $this->marketingRepo = $marketingRepo;
        $this->countryRepo = $countryRepo;
        $this->provinceRepo = $provinceRepo;
        $this->districtRepo = $districtRepo;
        $this->rankRepo = $rankRepo;
    }

    public function index() {
        $records = $this->marketingRepo->all();
        return view('backend/marketing/index', compact('records'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,$id) {
        $record = $this->marketingRepo->find($id);
        $search=$request->all();
        $orders = $this->marketingRepo->getData($request,$id);
        $rank_html = \App\Helpers\StringHelper::getSelectOptions($this->rankRepo->all(), $record->rank_id);
        $country_html = \App\Helpers\StringHelper::getSelectOptions($this->countryRepo->getAll(), $record->country_id);
        $province_html = \App\Helpers\StringHelper::getSelectOptions($this->provinceRepo->getAll(), $record->province_id);
        $district_html = \App\Helpers\StringHelper::getSelectOptions($this->districtRepo->getAll(), $record->district_id);
        return view('backend/marketing/edit', compact('record', 'rank_html', 'country_html', 'province_html', 'district_html','orders','search'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->marketingRepo->validate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($input['status']) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $res = $this->marketingRepo->update($input, $id);
        if ($res) {
            return redirect()->route('admin.marketing.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.marketing.index')->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $this->marketingRepo->delete($id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }

}
