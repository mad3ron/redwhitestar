<x-app-layout>
    {{-- <div class="mt-8">
        <a href="{{ route('pemesanan.index') }}" class="text-xl text-warning font-medium leading-none mt-3">
            Pembayaran Konsumen
        </a>

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="intro-y mt-5">
            <div class="col-span-12 uppercase font-bold">Nama Pemesan : {{ $pemesanan->nama_pemesan }} </div>
            <div class="col-span-12 uppercase">Tujuan : {{ $pemesanan->tujuans->tujuan }} - {{ $pemesanan->tujuans->pemakaian }}</div>
            <div class="col-span-12 uppercase font-bold">Harga Dasar : {{ number_format($pemesanan->harga, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase">Jumlah Bis : {{  number_format($jmlBis, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase">Biaya Jemput : {{ number_format( $biayaJemput, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase">Discount: {{ number_format( $jmlDiscount, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase">Total Harga : {{ number_format($jumlahPembayaran, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase">Uang Diterima : {{ number_format($baruBayar, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase font-semibold">
                {{ $status }}: {{ $sisaPembayaran <= 0 ? '' : number_format($sisaPembayaran, 0, ',', '.') }}
            </div>
            <div class="col-span-12 uppercase text-success">User : {{ $pemesanan->user->name }} </div>
        </div>

        {{-- <div class="intro-y mt-5">
            <div class="col-span-12 uppercase font-bold">Nama Pemesan  : {{ $pembayaran->pemesanan->nama_pemesan }} </div>
            <div class="col-span-12 uppercase">Tujuan  : {{ $pembayaran->pemesanan->tujuans->tujuan }} - {{ $pembayaran->pemesanan->tujuans->pemakaian }}</div>
            <div class="col-span-12 uppercase">Harga Dasar : {{ number_format($pembayaran->pemesanan->harga, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase">Jumlah Bis  : {{ $jmlBis }} unit</div>
            <div class="col-span-12 uppercase">Biaya Jemput : {{ number_format($pembayaran->pemesanan->biaya_jemput, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase">Jumlah Bayar : {{ number_format( $jumlahBayar, 0, ',', '.') }} </div>
            {{-- <div class="col-span-12 uppercase">Discount: {{ number_format($jmlDiscount, 0, ',', '.') }} </div> --}}
            <div class="col-span-12 uppercase font-semibold">Total Pembayaran : {{ number_format($totalPembayaran, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase">
                {{ $status }}: {{ $sisaPembayaran <= 0 ? '' : number_format($sisaPembayaran, 0, ',', '.') }}
            </div>
            <div class="col-span-12 uppercase text-success">User : {{ $pembayaran->pemesanan->user->name }} </div>
            <div class="col-span-12 uppercase text-danger">Status : {{ $pembayaran->pemesanan->status}} </div>
        </div> --}}

        @if ($pemesanan&& $pemesanan->count() > 0)
            <div class="intro-y card">
                <div class="card-body mt-8">
                    <h6 class="text-lg text-success font-medium leading-none mt-3">Data Pembayaran</h6>
                    <table class="intro-y table table-bordered">
                        <thead>
                            <tr>
                                <th>Nomor Pembayaran</th>
                                <th>Tanggal Bayar</th>
                                <th>Kode Pembayaran</th>
                                <th>Jumlah Bayar</th>
                                <th>Keterangan</th>
                                <th>Penerima</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanan->pembayaran as $payment)
                                @if ($payment)
                                    <tr>
                                        <td>{{ $payment->nomorPembayaran }}</td>
                                        <td>{{ $payment->tgl_bayar }}</td>
                                        <td>{{ $payment->kode_pembayaran }}</td>
                                        <td>{{ number_format($payment->jml_bayar, 0, ',', '.') }}</td>
                                        <td>{{ $payment->keterangan }}</td>
                                        <td>{{ $payment->user->name }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="alert alert-danger">Pembayaran tidak ditemukan.</div>
        @endif

        @if ($pemesanans = Pemesanan::where('nopesan_id', $nopesan_id)->get())
            @if ($pemesanans->sum('jumlah_invoice') >= 3)
                <div class="alert alert-warning">
                    <h4>Jumlah Invoice: {{ number_format($pemesanans->sum('jumlah_invoice'), 0, ',', '.') }}</h4>
                </div>
            @else
                @if ($pembayaran && $pembayaran->status === 'lunas')
                    <div class="alert alert-danger">Pemesan belum melakukan pembayaran.</div>
                @endif
            @endif
        @endif

        <div class="mt-5 sm:mt-10">
            <a href="{{ route('pembayaran.create') }}" class="btn btn-primary mr-2">Bayar</a>
            <a href="{{ route('pemesanan.index') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
    <script>
        document.getElementById('pembayaran-submit').addEventListener('click', function () {
            var status = document.getElementById('status').value;
            var pemesananId = '{{ $pembayaran->pemesanan->id }}';

            // Kirim permintaan AJAX untuk menyimpan perubahan status
            fetch('/update-status/' + pemesananId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ status: status }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Status telah diperbarui.');
                    // Tambahkan logika tambahan jika diperlukan, seperti memperbarui tampilan.
                } else {
                    alert('Gagal memperbarui status.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script> --}}

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row invoice-preview">
      <!-- Invoice -->
      <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
        <div class="card invoice-preview-card">
          <div class="card-body">
            <div
              class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0"
            >
              <div class="mb-xl-0 mb-4">
                <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                  <svg
                    width="32"
                    height="22"
                    viewBox="0 0 32 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                      fill="#7367F0"
                    />
                    <path
                      opacity="0.06"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                      fill="#161616"
                    />
                    <path
                      opacity="0.06"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                      fill="#161616"
                    />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                      fill="#7367F0"
                    />
                  </svg>

                  <span class="app-brand-text fw-bold fs-4"> Vuexy </span>
                </div>
                <p class="mb-2">Office 149, 450 South Brand Brooklyn</p>
                <p class="mb-2">San Diego County, CA 91905, USA</p>
                <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
              </div>
              <div>
                <h4 class="fw-semibold mb-2">INVOICE #86423</h4>
                <div class="mb-2 pt-1">
                  <span>Date Issues:</span>
                  <span class="fw-semibold">April 25, 2021</span>
                </div>
                <div class="pt-1">
                  <span>Date Due:</span>
                  <span class="fw-semibold">May 25, 2021</span>
                </div>
              </div>
            </div>
          </div>
          <hr class="my-0" />
          <div class="card-body">
            <div class="row p-sm-3 p-0">
              <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                <h6 class="mb-3">Invoice To:</h6>
                <p class="mb-1">Thomas shelby</p>
                <p class="mb-1">Shelby Company Limited</p>
                <p class="mb-1">Small Heath, B10 0HF, UK</p>
                <p class="mb-1">718-986-6062</p>
                <p class="mb-0">peakyFBlinders@gmail.com</p>
              </div>
              <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                <h6 class="mb-4">Bill To:</h6>
                <table>
                  <tbody>
                    <tr>
                      <td class="pe-4">Total Due:</td>
                      <td><strong>$12,110.55</strong></td>
                    </tr>
                    <tr>
                      <td class="pe-4">Bank name:</td>
                      <td>American Bank</td>
                    </tr>
                    <tr>
                      <td class="pe-4">Country:</td>
                      <td>United States</td>
                    </tr>
                    <tr>
                      <td class="pe-4">IBAN:</td>
                      <td>ETD95476213874685</td>
                    </tr>
                    <tr>
                      <td class="pe-4">SWIFT code:</td>
                      <td>BR91905</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="table-responsive border-top">
            <table class="table m-0">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Description</th>
                  <th>Cost</th>
                  <th>Qty</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-nowrap">Vuexy Admin Template</td>
                  <td class="text-nowrap">HTML Admin Template</td>
                  <td>$32</td>
                  <td>1</td>
                  <td>$32.00</td>
                </tr>
                <tr>
                  <td class="text-nowrap">Frest Admin Template</td>
                  <td class="text-nowrap">Angular Admin Template</td>
                  <td>$22</td>
                  <td>1</td>
                  <td>$22.00</td>
                </tr>
                <tr>
                  <td class="text-nowrap">Apex Admin Template</td>
                  <td class="text-nowrap">HTML Admin Template</td>
                  <td>$17</td>
                  <td>2</td>
                  <td>$34.00</td>
                </tr>
                <tr>
                  <td class="text-nowrap">Robust Admin Template</td>
                  <td class="text-nowrap">React Admin Template</td>
                  <td>$66</td>
                  <td>1</td>
                  <td>$66.00</td>
                </tr>
                <tr>
                  <td colspan="3" class="align-top px-4 py-4">
                    <p class="mb-2 mt-3">
                      <span class="ms-3 fw-semibold">Salesperson:</span>
                      <span>Alfie Solomons</span>
                    </p>
                    <span class="ms-3">Thanks for your business</span>
                  </td>
                  <td class="text-end pe-3 py-4">
                    <p class="mb-2 pt-3">Subtotal:</p>
                    <p class="mb-2">Discount:</p>
                    <p class="mb-2">Tax:</p>
                    <p class="mb-0 pb-3">Total:</p>
                  </td>
                  <td class="ps-2 py-4">
                    <p class="fw-semibold mb-2 pt-3">$154.25</p>
                    <p class="fw-semibold mb-2">$00.00</p>
                    <p class="fw-semibold mb-2">$50.00</p>
                    <p class="fw-semibold mb-0 pb-3">$204.25</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="card-body mx-3">
            <div class="row">
              <div class="col-12">
                <span class="fw-semibold">Note:</span>
                <span
                  >It was a pleasure working with you and your team. We hope you will keep us in mind for
                  future freelance projects. Thank You!</span
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /Invoice -->

      <!-- Invoice Actions -->
      <div class="col-xl-3 col-md-4 col-12 invoice-actions">
        <div class="card">
          <div class="card-body">
            <button
              class="btn btn-primary d-grid w-100 mb-2"
              data-bs-toggle="offcanvas"
              data-bs-target="#sendInvoiceOffcanvas"
            >
              <span class="d-flex align-items-center justify-content-center text-nowrap"
                ><i class="ti ti-send ti-xs me-1"></i>Send Invoice</span
              >
            </button>
            <button class="btn btn-label-secondary d-grid w-100 mb-2">Download</button>
            <a
              class="btn btn-label-secondary d-grid w-100 mb-2"
              target="_blank"
              href="./app-invoice-print.html"
            >
              Print
            </a>
            <a href="./app-invoice-edit.html" class="btn btn-label-secondary d-grid w-100 mb-2">
              Edit Invoice
            </a>
            <button
              class="btn btn-primary d-grid w-100"
              data-bs-toggle="offcanvas"
              data-bs-target="#addPaymentOffcanvas"
            >
              <span class="d-flex align-items-center justify-content-center text-nowrap"
                ><i class="ti ti-currency-dollar ti-xs me-1"></i>Add Payment</span
              >
            </button>
          </div>
        </div>
      </div>
      <!-- /Invoice Actions -->
    </div>

    <!-- Offcanvas -->
    <!-- Send Invoice Sidebar -->
    <div class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">
      <div class="offcanvas-header my-1">
        <h5 class="offcanvas-title">Send Invoice</h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body pt-0 flex-grow-1">
        <form>
          <div class="mb-3">
            <label for="invoice-from" class="form-label">From</label>
            <input
              type="text"
              class="form-control"
              id="invoice-from"
              value="shelbyComapny@email.com"
              placeholder="company@email.com"
            />
          </div>
          <div class="mb-3">
            <label for="invoice-to" class="form-label">To</label>
            <input
              type="text"
              class="form-control"
              id="invoice-to"
              value="qConsolidated@email.com"
              placeholder="company@email.com"
            />
          </div>
          <div class="mb-3">
            <label for="invoice-subject" class="form-label">Subject</label>
            <input
              type="text"
              class="form-control"
              id="invoice-subject"
              value="Invoice of purchased Admin Templates"
              placeholder="Invoice regarding goods"
            />
          </div>
          <div class="mb-3">
            <label for="invoice-message" class="form-label">Message</label>
            <textarea class="form-control" name="invoice-message" id="invoice-message" cols="3" rows="8">
Dear Queen Consolidated,
Thank you for your business, always a pleasure to work with you!
We have generated a new invoice in the amount of $95.59
We would appreciate payment of this invoice by 05/11/2021</textarea
            >
          </div>
          <div class="mb-4">
            <span class="badge bg-label-primary">
              <i class="ti ti-link ti-xs"></i>
              <span class="align-middle">Invoice Attached</span>
            </span>
          </div>
          <div class="mb-3 d-flex flex-wrap">
            <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /Send Invoice Sidebar -->

    <!-- Add Payment Sidebar -->
    <div class="offcanvas offcanvas-end" id="addPaymentOffcanvas" aria-hidden="true">
      <div class="offcanvas-header mb-3">
        <h5 class="offcanvas-title">Add Payment</h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body flex-grow-1">
        <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
          <p class="mb-0">Invoice Balance:</p>
          <p class="fw-bold mb-0">$5000.00</p>
        </div>
        <form>
          <div class="mb-3">
            <label class="form-label" for="invoiceAmount">Payment Amount</label>
            <div class="input-group">
              <span class="input-group-text">$</span>
              <input
                type="text"
                id="invoiceAmount"
                name="invoiceAmount"
                class="form-control invoice-amount"
                placeholder="100"
              />
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="payment-date">Payment Date</label>
            <input id="payment-date" class="form-control invoice-date" type="text" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="payment-method">Payment Method</label>
            <select class="form-select" id="payment-method">
              <option value="" selected disabled>Select payment method</option>
              <option value="Cash">Cash</option>
              <option value="Bank Transfer">Bank Transfer</option>
              <option value="Debit Card">Debit Card</option>
              <option value="Credit Card">Credit Card</option>
              <option value="Paypal">Paypal</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="form-label" for="payment-note">Internal Payment Note</label>
            <textarea class="form-control" id="payment-note" rows="2"></textarea>
          </div>
          <div class="mb-3 d-flex flex-wrap">
            <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /Add Payment Sidebar -->

    <!-- /Offcanvas -->
  </div>
</x-app-layout>
