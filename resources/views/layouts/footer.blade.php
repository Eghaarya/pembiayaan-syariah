<!-- Required Js -->
<script src="{{ asset('js/vendor-all.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/pcoded.min.js') }}"></script>

<script>
    // Start tanggal pencairan
    function toggleTanggalPencairan() {
        const keputusanInput = document.getElementById('keputusan');
        const wrapper = document.getElementById('tanggalPencairanWrapper');
        const tanggalInput = document.getElementById('tanggal_pencairan');

        if (!keputusanInput || !wrapper || !tanggalInput) return;

        const keputusan = keputusanInput.value;

        if (keputusan === 'disetujui') {
            wrapper.style.display = 'block';
            tanggalInput.required = true; // Wajib diisi jika tampil
        } else {
            wrapper.style.display = 'none';
            tanggalInput.value = '';
            tanggalInput.required = false; // Hilangkan required jika disembunyikan
        }
    }
    // End tanggal pencairan

    // Start nilai pembiayaan permohonan, keputusan
    function hitungAngsuranPerBulan(prefix) {
        const jangka = document.getElementById(`${prefix}_jangka_waktu_pembiayaan`);
        const bulanOutput = document.getElementById(`${prefix}_jangka_waktu_bulan`);
        const margin = document.getElementById(`${prefix}_margin_bank`);
        const harga = document.getElementById(`${prefix}_harga_beli_bank`);
        const marginTahunOutput = document.getElementById(`${prefix}_margin_tahun_output`);
        const nominalOutput = document.getElementById(`${prefix}_margin_nominal_output`);
        const hargaJualOutput = document.getElementById(`${prefix}_harga_jual_output`);
        const angsuranOutput = document.getElementById(`${prefix}_angsuran_bank_output`);

        function updateBulan() {
            const tahunInput = parseFloat(jangka?.value || 0);
            if (!isNaN(tahunInput) && tahunInput > 0) {
                const bulan = tahunInput * 12;
                if (bulanOutput) bulanOutput.innerText = bulan + ' bulan';
            } else {
                if (bulanOutput) bulanOutput.innerText = '—';
            }
        }

        function updateOutput() {
            const marginPerBulan = parseFloat(margin?.value) || 0;
            const jangkaTahun = parseFloat(jangka?.value) || 0;
            const hargaBeli = parseFloat(harga?.value) || 0;

            const jangkaBulan = jangkaTahun * 12;
            const marginTahun = marginPerBulan * jangkaTahun;

            if (marginTahunOutput)
                marginTahunOutput.innerText = jangkaTahun > 0 ? `${marginTahun.toFixed(2)}%` : '—';

            if (marginPerBulan > 0 && jangkaTahun > 0 && hargaBeli > 0) {
                const nominalMargin = (marginTahun / 100) * hargaBeli;
                const hargaJual = hargaBeli + nominalMargin;
                const angsuran = hargaJual / jangkaBulan;

                if (nominalOutput)
                    nominalOutput.innerText = `Rp ${nominalMargin.toLocaleString('id-ID')}`;
                if (hargaJualOutput)
                    hargaJualOutput.innerText = `Rp ${hargaJual.toLocaleString('id-ID')}`;
                if (angsuranOutput)
                    angsuranOutput.innerText = `Rp ${angsuran.toLocaleString('id-ID', { minimumFractionDigits: 0 })}`;
            } else {
                if (nominalOutput) nominalOutput.innerText = '—';
                if (hargaJualOutput) hargaJualOutput.innerText = '—';
                if (angsuranOutput) angsuranOutput.innerText = '—';
            }
        }

        // Jalankan hanya jika elemen penting ada
        if (jangka && margin && harga) {
            updateBulan();
            updateOutput();

            jangka.addEventListener('input', () => {
                updateBulan();
                updateOutput();
            });

            margin.addEventListener('input', updateOutput);
            harga.addEventListener('input', updateOutput);
        }
    }
    // End nilai pembiayaan permohonan, keputusan

    // Start tambah hapus baris table
    function initSimpleTableAddRemove({
        tableId,
        btnAddId,
        btnRemoveId,
        rowTemplateCallback
    }) {
        const table = document.getElementById(tableId);
        if (!table) return;
        const tbody = table.querySelector('tbody');
        if (!tbody) return;

        let rowIndex = tbody.rows.length;

        function updateRowNumbers() {
            Array.from(tbody.rows).forEach((row, i) => {
                row.cells[0].textContent = i + 1;
                // Update name attributes index sesuai baris
                const inputs = row.querySelectorAll('input, select');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (!name) return;
                    const newName = name.replace(/\[\d+\]/, `[${i}]`);
                    input.setAttribute('name', newName);
                });
            });
        }

        function addRow() {
            const tr = document.createElement('tr');
            tr.innerHTML = rowTemplateCallback(rowIndex);
            tbody.appendChild(tr);
            rowIndex++;
            updateRowNumbers();
        }

        function removeLastRow() {
            if (tbody.rows.length === 0) return;
            tbody.deleteRow(tbody.rows.length - 1);
            rowIndex--;
            updateRowNumbers();
        }

        const btnAdd = document.getElementById(btnAddId);
        if (!btnAdd) return;
        btnAdd.addEventListener('click', addRow);

        const btnRemove = document.getElementById(btnRemoveId);
        if (!btnRemove) return;
        btnRemove.addEventListener('click', removeLastRow);
    }
    // End tambah hapus baris table

    // Start hitung total penghasila, pengeluaran, bersih
    function hitungTotal() {
        let totalPenghasilan = 0;
        let totalPengeluaran = 0;

        // Hitung total penghasilan
        const penghasilanInputs = document.querySelectorAll('.penghasilan-input');
        if (penghasilanInputs.length > 0) {
            penghasilanInputs.forEach(input => {
                let value = parseFloat(input.value);
                if (!isNaN(value)) {
                    totalPenghasilan += value;
                }
            });
        }

        // Hitung total pengeluaran
        const pengeluaranInputs = document.querySelectorAll('.pengeluaran-input');
        if (pengeluaranInputs.length > 0) {
            pengeluaranInputs.forEach(input => {
                let value = parseFloat(input.value);
                if (!isNaN(value)) {
                    totalPengeluaran += value;
                }
            });
        }

        let penghasilanBersih = totalPenghasilan - totalPengeluaran;

        const setTextIfExist = (id, value) => {
            const el = document.getElementById(id);
            if (el) el.textContent = formatRupiah(value);
        };

        setTextIfExist('total-penghasilan', totalPenghasilan);
        setTextIfExist('total-pengeluaran', totalPengeluaran);
        setTextIfExist('penghasilan-bersih', penghasilanBersih);

        let maksimalAngsuran1 = penghasilanBersih * 0.7;
        let maksimalAngsuran2 = totalPenghasilan * 0.4;

        setTextIfExist('nominal-alternatif-1', penghasilanBersih);
        setTextIfExist('nominal-alternatif-2', totalPenghasilan);
        setTextIfExist('maks-angsuran-1', maksimalAngsuran1);
        setTextIfExist('maks-angsuran-2', maksimalAngsuran2);

        hitungHargaJual();
        hitungAngsuranAnalis()
    }
    // End hitung total penghasila, pengeluaran, bersih

    // Start nilai pembiayaan gross income, net income, terkecil, analis
    function hitungHargaJual() {

        let total_penghasilan = parseCurrency(document.getElementById('total-penghasilan')?.textContent || '0');
        let penghasilan_bersih = parseCurrency(document.getElementById('penghasilan-bersih')?.textContent || '0');
        let angsuran1 = penghasilan_bersih * 0.7; // netincome * 70%
        let angsuran2 = total_penghasilan * 0.4; // grossincome * 40%
        let angsuran_analis = parseCurrency(document.getElementById('analis_angsuran_per_bulan')?.value || '0');

        let terkecilAngsuran = Math.min(angsuran1, angsuran2);
        let sumberPenghasilanTerkecil = (terkecilAngsuran === angsuran1) ? penghasilan_bersih : total_penghasilan;

        kategoriHargaJual('grossincome', total_penghasilan, angsuran2);
        kategoriHargaJual('netincome', penghasilan_bersih, angsuran1);
        kategoriHargaJual('terkecil', sumberPenghasilanTerkecil, terkecilAngsuran);
        kategoriHargaJual('analis', penghasilan_bersih, angsuran_analis);

        // Harga Beli Bank
        const netincome_harga_beli_bank = document.getElementById('netincome_harga_beli_bank');
        const analis_harga_beli_bank = document.getElementById('analis_harga_beli_bank');
        const fromDb_harga_beli = document.getElementById('analis_harga_beli_bank_from_db')?.value === '1';

        if (netincome_harga_beli_bank && analis_harga_beli_bank && !fromDb_harga_beli) {
            const angka = parseCurrency(netincome_harga_beli_bank.textContent);
            analis_harga_beli_bank.value = angka;
        }

        // Margin Bank
        const netincome_margin_bank = document.getElementById('netincome_margin_bank');
        const analis_margin_bank = document.getElementById('analis_margin_bank');
        const fromDb_margin = document.getElementById('analis_margin_bank_from_db')?.value === '1';

        if (netincome_margin_bank && analis_margin_bank && !fromDb_margin) {
            const angka = parseCurrency(netincome_margin_bank.textContent);
            analis_margin_bank.value = angka;
        }

        // Harga Jual Bank
        const netincome_harga_jual_bank = document.getElementById('netincome_harga_jual_bank');
        const analis_harga_jual_bank = document.getElementById('analis_harga_jual_bank');
        const fromDb_jual = document.getElementById('analis_harga_jual_bank_from_db')?.value === '1';

        if (netincome_harga_jual_bank && analis_harga_jual_bank && !fromDb_jual) {
            const angka = parseCurrency(netincome_harga_jual_bank.textContent);
            analis_harga_jual_bank.value = angka;
        }

    }

    function kategoriHargaJual(prefix, pendapatan, angsuranPerBulan) {
        let tahunInput = document.getElementById(`${prefix}_jangka_waktu_pembiayaan`);
        if (!tahunInput) return;

        let rawText = tahunInput.textContent || tahunInput.value || '0';
        let tahun = parseFloat(rawText.replace(/[^\d.]/g, '')) || 0;
        let bulan = tahun * 12;

        let hargaJual = angsuranPerBulan * bulan;
        let harga_beli_bank = (1 + tahun) !== 0 ? hargaJual / (1 + tahun) : 0;
        let margin = hargaJual - harga_beli_bank;
        let repayment = angsuranPerBulan > 0 ? Math.ceil(pendapatan / angsuranPerBulan) : 0;

        // Fallback jika NaN
        hargaJual = isNaN(hargaJual) ? 0 : hargaJual;
        harga_beli_bank = isNaN(harga_beli_bank) ? 0 : harga_beli_bank;
        margin = isNaN(margin) ? 0 : margin;
        repayment = isNaN(repayment) ? 0 : repayment;

        // Tampilkan hasil
        const setText = (idSuffix, value, isRupiah = true) => {
            let el = document.getElementById(`${prefix}_${idSuffix}`);
            if (el) {
                el.textContent = ': ' + (isRupiah ? formatRupiah(value) : value);
            }
        };

        setText('jangka_waktu_bulan', bulan + ' bulan', false); // tidak format rupiah
        setText('angsuran_per_bulan', angsuranPerBulan);
        setText('harga_jual_bank', hargaJual);
        setText('harga_beli_bank', harga_beli_bank);
        setText('margin_bank', margin);
        setText('repayment', repayment + ' kali', false);
    }

    function hitungAngsuranAnalis() {
        const inputHargaBeli = document.getElementById('analis_harga_beli_bank');
        const inputTahun = document.getElementById('analis_jangka_waktu_pembiayaan');
        const inputMargin = document.getElementById('analis_margin_bank');
        const inputAngsuran = document.getElementById('analis_angsuran_per_bulan');
        const inputSaveMarginPerTahun = document.getElementById('save_analis_margin_bank_from_db');
        const inputBulan = document.getElementById('analis_jangka_waktu_bulan');
        const elRepayment = document.getElementById('analis_repayment');
        const penghasilanBersih = parseCurrency(document.getElementById('penghasilan-bersih')?.textContent || '0');

        if (!inputHargaBeli || !inputTahun || !inputMargin || !inputAngsuran) return;

        const hargaBeli = parseFloat(inputHargaBeli.value) || 0;
        const margin = parseFloat(inputMargin.value) || 0;

        const tahunRaw = inputTahun.value || inputTahun.textContent || '0';
        const tahun = parseFloat(tahunRaw.replace(/[^\d.]/g, '')) || 0;
        const bulan = tahun * 12;

        inputBulan.textContent = ': ' + bulan + ' bulan';

        const angsuran = (hargaBeli > 0 && bulan > 0) ? (hargaBeli + margin) / bulan : 0;
        inputAngsuran.value = ': ' + formatRupiah(angsuran);

        // Hitung repayment capacity
        const repayment = (angsuran > 0) ? Math.ceil(penghasilanBersih / angsuran) : 0;
        if (elRepayment) {
            elRepayment.textContent = ': ' + repayment + ' kali';
        }

        // Hitung margin per tahun
        if (inputSaveMarginPerTahun && hargaBeli > 0 && tahun > 0) {
            const marginPerTahun = ((margin / hargaBeli) / tahun) * 100;
            inputSaveMarginPerTahun.value = parseFloat(marginPerTahun.toFixed(10)).toString();
        }
    }

    function parseCurrency(str) {
        return parseFloat(str.replace(/[^0-9,-]+/g, '').replace(',', '.')) || 0;
    }

    function formatRupiah(angka) {
        return 'Rp. ' + angka.toLocaleString('id-ID', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }
    // End nilai pembiayaan gross income, net income, terkecil, analis

    window.addEventListener('DOMContentLoaded', () => {
        // Cari semua alert dengan class 'alert-animate'
        document.querySelectorAll('.alert-animate').forEach(alertBox => {
            setTimeout(() => {
                alertBox.classList.remove('alert-animate');
                alertBox.classList.add('alert-hide');
                setTimeout(() => {
                    alertBox.remove();
                }, 400);
            }, 3000);
        });

        if (document.getElementById('keputusan')) {
            toggleTanggalPencairan();
            document.getElementById('keputusan').addEventListener('change', toggleTanggalPencairan);
        }

        document.querySelectorAll('[id^="nav-"]').forEach(nav => {
            nav.addEventListener('click', function() {
                const paneId = nav.id;
                const tabPane = document.getElementById(paneId);
                if (!tabPane) return;

                const target = tabPane.querySelector('#target-shake');
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    setTimeout(() => {
                        target.classList.add('shake');
                        setTimeout(() => {
                            target.classList.remove('shake');
                        }, 500);
                    }, 500);
                }
            });
        });

        hitungTotal();
        hitungHargaJual();
        hitungAngsuranAnalis()

        hitungAngsuranPerBulan('permohonan');
        hitungAngsuranPerBulan('keputusan');

        const checkingTables = ['nasabah', 'pasangan'];
        checkingTables.forEach(prefix => {
            initSimpleTableAddRemove({
                tableId: `table-checking-${prefix}`,
                btnAddId: `btn-add-row-checking-${prefix}`,
                btnRemoveId: `btn-remove-row-checking-${prefix}`,
                rowTemplateCallback: (index) => `
                    <input type="hidden" name="id_checking_${prefix}[${index}][id]">
                    <td class="p-1 text-center align-middle">${index + 1}</td>
                    <td class="p-1"><input type="text" name="id_checking_${prefix}[${index}][noid_checking]" class="form-control text-center align-middle"></td>
                    <td class="p-1"><input type="text" name="id_checking_${prefix}[${index}][nama_debitur]" class="form-control text-center align-middle"></td>
                    <td class="p-1"><input type="text" name="id_checking_${prefix}[${index}][fasilitas_pinjaman]" class="form-control text-center align-middle"></td>
                    <td class="p-1"><input type="text" name="id_checking_${prefix}[${index}][bank_pelapor]" class="form-control text-center align-middle"></td>
                    <td class="p-1"><input type="number" step="0.01" name="id_checking_${prefix}[${index}][plafond_pinjaman]" class="form-control text-center align-middle"></td>
                    <td class="p-1"><input type="number" step="0.01" name="id_checking_${prefix}[${index}][outstanding_pinjaman]" class="form-control text-center align-middle"></td>
                    <td class="p-1"><input type="date" name="id_checking_${prefix}[${index}][tanggal_realisasi]" class="form-control text-center align-middle"></td>
                    <td class="p-1"><input type="date" name="id_checking_${prefix}[${index}][tanggal_jatuh_tempo]" class="form-control text-center align-middle"></td>
                    <td class="p-1">
                        <select name="id_checking_${prefix}[${index}][kolektabilitas]" class="form-control">
                            <option>--</option>
                            <option>LANCAR/TIDAK MENUNGGAK (5)</option>
                            <option>MENUNGGAK 1 - 2 (4)</option>
                            <option>MENUNGGAK 3 - 6 (3)</option>
                            <option>MENUNGGAK 7 - 10 (2)</option>
                            <option>MENUNGGAK >10 (1)</option>
                        </select>
                    </td>
                    <td class="p-1"><input type="text" name="id_checking_${prefix}[${index}][keterangan]" class="form-control text-center align-middle"></td>
                    <td class="p-1"><input type="text" name="id_checking_${prefix}[${index}][agunan]" class="form-control text-center align-middle"></td>
                `
            });
        });

        const asetTablesAktivalancar = ['aktivalancar'];
        asetTablesAktivalancar.forEach(prefix => {
            initSimpleTableAddRemove({
                tableId: `table-aset-${prefix}`,
                btnAddId: `btn-add-row-aset-${prefix}`,
                btnRemoveId: `btn-remove-row-aset-${prefix}`,
                rowTemplateCallback: (index) => `
                    <input type="hidden" name="id_aset_${prefix}[${index}][id]">
                    <td class="p-1 text-center align-middle">${index + 1}</td>
                    <td class="p-1"><input type="text" name="id_aset_${prefix}[${index}][keterangan]" class="form-control form-control-sm text-center"></td>
                    <td class="p-1"><input type="number" name="id_aset_${prefix}[${index}][nilai]" class="form-control form-control-sm text-center" step="0.01"></td>
                `
            });
        });
        const asetTablesTanahbangunan = ['tanahbangunan'];
        asetTablesTanahbangunan.forEach(prefix => {
            initSimpleTableAddRemove({
                tableId: `table-aset-${prefix}`,
                btnAddId: `btn-add-row-aset-${prefix}`,
                btnRemoveId: `btn-remove-row-aset-${prefix}`,
                rowTemplateCallback: (index) => `
                    <input type="hidden" name="id_aset_${prefix}[${index}][id]">
                    <td class="p-1 text-center align-middle">${index + 1}</td>
                    <td class="p-1"><input type="text" name="id_aset_${prefix}[${index}][lokasi]" class="form-control form-control-sm text-center"></td>
                    <td class="p-1"><input type="text" name="id_aset_${prefix}[${index}][luas_tanah_bangunan]" class="form-control form-control-sm text-center"></td>
                    <td class="p-1"><input type="text" name="id_aset_${prefix}[${index}][status]" class="form-control form-control-sm text-center"></td>
                    <td class="p-1"><input type="text" name="id_aset_${prefix}[${index}][atas_nama]" class="form-control form-control-sm text-center"></td>
                    <td class="p-1"><input type="number" name="id_aset_${prefix}[${index}][nilai]" class="form-control form-control-sm text-center" step="0.01"></td>
                `
            });
        });
        const asetTablesKendaraan = ['kendaraan'];
        asetTablesKendaraan.forEach(prefix => {
            initSimpleTableAddRemove({
                tableId: `table-aset-${prefix}`,
                btnAddId: `btn-add-row-aset-${prefix}`,
                btnRemoveId: `btn-remove-row-aset-${prefix}`,
                rowTemplateCallback: (index) => `
                    <input type="hidden" name="id_aset_${prefix}[${index}][id]">
                    <td class="p-1 text-center align-middle">${index + 1}</td>
                    <td class="p-1"><input type="text" name="id_aset_${prefix}[${index}][jenis_merek]" class="form-control form-control-sm text-center"></td>
                    <td class="p-1"><input type="text" name="id_aset_${prefix}[${index}][tahun_pembuatan]" class="form-control form-control-sm text-center"></td>
                    <td class="p-1"><input type="text" name="id_aset_${prefix}[${index}][atas_nama]" class="form-control form-control-sm text-center"></td>
                    <td class="p-1"><input type="number" name="id_aset_${prefix}[${index}][nilai]" class="form-control form-control-sm text-center" step="0.01"></td>
                `
            });
        });
        const asetTablesLainnya = ['lainnya'];
        asetTablesLainnya.forEach(prefix => {
            initSimpleTableAddRemove({
                tableId: `table-aset-${prefix}`,
                btnAddId: `btn-add-row-aset-${prefix}`,
                btnRemoveId: `btn-remove-row-aset-${prefix}`,
                rowTemplateCallback: (index) => `
                    <input type="hidden" name="id_aset_${prefix}[${index}][id]">
                    <td class="p-1 text-center align-middle">${index + 1}</td>
                    <td class="p-1"><input type="text" name="id_aset_${prefix}[${index}][jenis]" class="form-control form-control-sm text-center"></td>
                    <td class="p-1"><input type="text" name="id_aset_${prefix}[${index}][lokasi]" class="form-control form-control-sm text-center"></td>
                    <td class="p-1"><input type="text" name="id_aset_${prefix}[${index}][atas_nama]" class="form-control form-control-sm text-center"></td>
                    <td class="p-1"><input type="number" name="id_aset_${prefix}[${index}][nilai]" class="form-control form-control-sm text-center" step="0.01"></td>
                `
            });
        });

    });
</script>


</body>

</html>
