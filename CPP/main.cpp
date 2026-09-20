#include <iostream>
#include <vector>
#include "film.cpp"

using namespace std;

void tampilkanMenu() {
    cout << "\n=== SISTEM MANAJEMEN BIOSKOP (C++) ===" << endl;
    cout << "1. Tambah Data Film" << endl;
    cout << "2. Tampilkan Semua Film" << endl;
    cout << "3. Update Data Film" << endl;
    cout << "4. Hapus Data Film" << endl;
    cout << "5. Cari Data Film" << endl;
    cout << "6. Keluar" << endl;
    cout << "Pilih menu (1-6): ";
}

int cariIndexFilm(vector<Film>& daftarFilm, const string& id) {
    for (size_t i = 0; i < daftarFilm.size(); i++) {
        if (daftarFilm[i].getId() == id) {
            return i;
        }
    }
    return -1;
}

int main() {
    vector<Film> daftarFilm;
    int pilihan;

    do {
        tampilkanMenu();
        cin >> pilihan;
        cin.ignore();

        if (pilihan == 1) {
            string id, judul, genre;
            int durasi;
            cout << "\n--- Tambah Film ---" << endl;
            cout << "ID Film    : "; getline(cin, id);
            cout << "Judul Film : "; getline(cin, judul);
            cout << "Genre      : "; getline(cin, genre);
            cout << "Durasi (m) : "; cin >> durasi;

            daftarFilm.push_back(Film(id, judul, genre, durasi));
            cout << "Data film berhasil ditambahkan!" << endl;
        } 
        else if (pilihan == 2) {
            cout << "\n--- Daftar Film ---" << endl;
            if (daftarFilm.empty()) {
                cout << "Belum ada data film." << endl;
            } else {
                for (size_t i = 0; i < daftarFilm.size(); i++) {
                    cout << i + 1 << ". ID: " << daftarFilm[i].getId()
                         << " | Judul: " << daftarFilm[i].getJudul()
                         << " | Genre: " << daftarFilm[i].getGenre()
                         << " | Durasi: " << daftarFilm[i].getDurasi() << " menit" << endl;
                }
            }
        } 
        else if (pilihan == 3) {
            string id;
            cout << "\n--- Update Film ---" << endl;
            cout << "Masukkan ID Film yang ingin diubah: "; getline(cin, id);
            int idx = cariIndexFilm(daftarFilm, id);
            if (idx != -1) {
                string judul, genre;
                int durasi;
                cout << "Judul Baru : "; getline(cin, judul);
                cout << "Genre Baru : "; getline(cin, genre);
                cout << "Durasi Baru: "; cin >> durasi;

                daftarFilm[idx].setJudul(judul);
                daftarFilm[idx].setGenre(genre);
                daftarFilm[idx].setDurasi(durasi);
                cout << "Data film berhasil diupdate!" << endl;
            } else {
                cout << "Film dengan ID tersebut tidak ditemukan!" << endl;
            }
        } 
        else if (pilihan == 4) {
            string id;
            cout << "\n--- Hapus Film ---" << endl;
            cout << "Masukkan ID Film yang ingin dihapus: "; getline(cin, id);
            int idx = cariIndexFilm(daftarFilm, id);
            if (idx != -1) {
                daftarFilm.erase(daftarFilm.begin() + idx);
                cout << "Data film berhasil dihapus!" << endl;
            } else {
                cout << "Film dengan ID tersebut tidak ditemukan!" << endl;
            }
        } 
        else if (pilihan == 5) {
            string id;
            cout << "\n--- Cari Film ---" << endl;
            cout << "Masukkan ID Film yang dicari: "; getline(cin, id);
            int idx = cariIndexFilm(daftarFilm, id);
            if (idx != -1) {
                cout << "Data Ditemukan:" << endl;
                cout << "ID     : " << daftarFilm[idx].getId() << endl;
                cout << "Judul  : " << daftarFilm[idx].getJudul() << endl;
                cout << "Genre  : " << daftarFilm[idx].getGenre() << endl;
                cout << "Durasi : " << daftarFilm[idx].getDurasi() << " menit" << endl;
            } else {
                cout << "Film dengan ID tersebut tidak ditemukan!" << endl;
            }
        }
    } while (pilihan != 6);

    cout << "Program selesai. Terima kasih!" << endl;
    return 0;
}