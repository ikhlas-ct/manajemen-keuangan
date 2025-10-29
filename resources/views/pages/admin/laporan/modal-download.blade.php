<div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header">
        <h5 class="modal-title fw-semibold" id="downloadModalLabel">Unduh Laporan Keuangan</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="bulan" class="form-label fw-semibold">Pilih Bulan</label>
            <select id="bulan" class="form-select">
              <option selected disabled>-- Pilih Bulan --</option>
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
          <div class="mb-3">
            <label for="tahun" class="form-label fw-semibold">Pilih Tahun</label>
            <select id="tahun" class="form-select">
              <option selected disabled>-- Pilih Tahun --</option>
              @for($i = 2023; $i <= 2025; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>
          </div>
          <div class="text-end">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" onclick="window.open('{{ url('/laporan/pdf') }}', '_blank')">
                <i class="mdi mdi-download me-1"></i> Unduh PDF
            </button>

            {{-- <button type="submit" class="btn btn-primary"><a href="{{ url('/laporan/pdf') }}">Unduh PDF</a></button> --}}
            {{-- <a href="{{ url('/laporan/pdf') }}" target="_blank" class="btn btn-primary" id="btnUnduh">
          <i class="mdi mdi-download me-1"></i> Unduh --}}
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
