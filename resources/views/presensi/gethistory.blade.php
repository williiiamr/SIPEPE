<div class="presencetab">
    <div class="tab-content" style="margin-bottom:100px;">
        <div class="tab-pane fade show active" id="home" role="tabpanel">
            <ul class="listview image-listview" style="border-radius: 20px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px; margin: 10px; padding: 5px;">
                @foreach ($history as $d)
                    <li>
                        <div class="item" style='width:92vw;'>
                            <div class="icon-box bg-primary">
                                <ion-icon name="image-outline" role="img" class="md hydrated"
                                    aria-label="image outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>{{ date('Y-m-d', strtotime($d->tgl_presensi)) }}</div>
                                <span class="badge gradasigreen">{{ $d->jam_in }}</span>
                                <span class="badge badge-danger">{{ $d->jam_out }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>    
        </div>
    </div>
</div>  