<div class="modal fade" id="laporanModal" tabindex="-1" role="dialog" aria-labelledby="laporanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="laporanModalLabel">
                    <i class="bi bi-funnel-fill mr-2"></i> Pilih Periode
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs mb-3" id="laporanTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="bulanan-tab" data-toggle="tab" href="#bulanan" role="tab">Bulanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tahunan-tab" data-toggle="tab" href="#tahunan" role="tab">Tahunan</a>
                    </li>
                </ul>
                <div class="tab-content" id="laporanTabContent">
                    {{-- Bulanan --}}
                    <div class="tab-pane fade show active" id="bulanan" role="tabpanel">
                        <form action="{{ route('laporan.cetak') }}" method="GET" target="_blank">
                        <input type="hidden" name="jenis" value="bulanan">
                        <div class="form-group">
                            <label for="bulan" class="font-weight-bold">Pilih Bulan</label>
                            <select class="form-control" id="bulan" name="bulan" required>
                            <option value="" selected disabled>-- Pilih Bulan --</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun" class="font-weight-bold">Pilih Tahun</label>
                            <select class="form-control" id="tahun" name="tahun" required>
                                <option value="" selected disabled>-- Pilih Tahun --</option>
                                @for ($i = date('Y'); $i >= 2020; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-danger">
                            <i class="bi bi-file-earmark-pdf-fill mr-1"></i> Unduh
                            </button>
                        </div>
                        </form>
                    </div>
                    {{-- tahunan --}}
                    <div class="tab-pane fade" id="tahunan" role="tabpanel">
                        <form action="{{ route('laporan.cetak') }}" method="GET" target="_blank">
                        <input type="hidden" name="jenis" value="tahunan">
                        <div class="form-group">
                            <label for="tahun_tahunan" class="font-weight-bold">Pilih Tahun</label>
                            <select class="form-control" id="tahun_tahunan" name="tahun" required>
                                <option value="" selected disabled>-- Pilih Tahun --</option>
                                @for ($i = date('Y'); $i >= 2020; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-file-earmark-pdf-fill mr-1"></i> Unduh
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
