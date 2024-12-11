<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Http;
use Mary\Traits\Toast;
use App\Models\LogPengguna;
use Livewire\Attributes\Rule;

new
#[Layout('components.layouts.public')]
class extends Component {
    use Toast;

    #[Rule('required')]
    public string $name;

    #[Rule('required')]
    public int $umur;

    #[Rule('required')]
    public string $no_hp;

    #[Rule('required')]
    public string $umkm_name;

    #[Rule('required')]
    public string $provinsi;

    #[Rule('required')]
    public string $kabupaten;

    public array $provinsiOptions = [];
    public array $kabupatenOptions = [];

    public function mount()
    {
        // Fetch provinces when the component is mounted

        $this->fetchProvinces();
    }

    public function fetchProvinces()
    {
        try {
            $response = Http::get('https://putranta.github.io/api-wilayah-indonesia/api/provinces.json'); // Ganti dengan URL API yang sesuai
            if ($response->successful()) {
                $this->provinsiOptions = $response->json(); // Asumsikan API mengembalikan array nama provinsi
            }
        } catch (\Exception $e) {
            $this->provinsiOptions = [];
        }
    }

    public function updatedProvinsi($value)
    {
        $this->fetchKabupaten($value);
    }

    public function fetchKabupaten($provinsiId)
    {
        try {
            $response = Http::get("https://putranta.github.io/api-wilayah-indonesia/api/regencies/{$provinsiId}.json"); // Ganti URL dengan endpoint kabupaten
            if ($response->successful()) {
                $this->kabupatenOptions = $response->json(); // Asumsikan API mengembalikan array nama kabupaten
            }
        } catch (\Exception $e) {
            $this->kabupatenOptions = [];
        }
    }

    public function register(): void
    {
        $data = $this->validate();

        $provinsiId = $this->provinsi;
        $kabupatenId = $this->kabupaten;

        $response = Http::get("https://putranta.github.io/api-wilayah-indonesia/api/province/{$provinsiId}.json");
        $response2 = Http::get("https://putranta.github.io/api-wilayah-indonesia/api/regency/{$kabupatenId}.json");

        if ($response->successful() && $response2->successful()) {
            $prov = $response->json();
            $provinsiName = $prov['name'];

            $kab = $response2->json();
            $kabupatenName = $kab['name'];
        } else {
            \Log::error('Gagal mengambil data provinsi untuk ID: ' . $provinsiId);
            \Log::error('Gagal mengambil data kabupaten untuk ID: ' . $kabupatenId);
        }

        $data['provinsi'] = $provinsiName;
        $data['kabupaten'] = $kabupatenName;

        $pengguna = LogPengguna::create($data);

        $this->success('Registrasi Berhasil', redirectTo: "/form/user/{$pengguna->id}");
    }
}; ?>

<div class="">
    <div class="md:w-1/2 mx-auto mt-10">
        <x-card title="Registrasi Form" subtitle="Silahkan Mengisi Registrasi untuk Melanjutkan" shadow separator>
            <x-form wire:submit="register">
                <div class="flex flex-row gap-3">
                    <div class="basis-3/4">
                        <x-input label="Nama" wire:model="name" icon="o-user" inline />
                    </div>
                    <div class="basis-1/4">
                        <x-input label="Umur" wire:model="umur" icon="o-user" inline type="number" />
                    </div>
                </div>

                <x-input label="Nama UMKM" wire:model="umkm_name" icon="o-rocket-launch" inline />
                <x-input label="No HP/E-mail" wire:model="no_hp" icon="o-envelope" inline />

                <x-select label="Asal Provinsi" icon="o-globe-asia-australia" :options="$provinsiOptions"
                    placeholder="-- Pilih --" wire:model.live="provinsi" option-label="name" option-value="id" inline />

                <!-- Select Kabupaten -->
                <x-select label="Kabupaten/Kota" icon="o-building-office" :options="$kabupatenOptions" wire:model="kabupaten"
                    placeholder="-- Pilih --" option-label="name" option-value="id" inline />

                <x-slot:actions>
                    <x-button label="Already registered?" class="btn-ghost" link="/login" />
                    <x-button label="Register" type="submit" icon="o-paper-airplane" class="btn-primary"
                        spinner="register" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>

</div>
