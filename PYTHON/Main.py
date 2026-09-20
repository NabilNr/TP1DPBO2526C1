from Film import Film

def cari_index_film(daftar_film, id_film):
    for idx, film in enumerate(daftar_film):
        if film.get_id().lower() == id_film.lower():
            return idx
    return -1

def main():
    daftar_film = []
    
    while True:
        print("\n=== SISTEM MANAJEMEN BIOSKOP (PYTHON) ===")
        print("1. Tambah Data Film")
        print("2. Tampilkan Semua Film")
        print("3. Update Data Film")
        print("4. Hapus Data Film")
        print("5. Cari Data Film")
        print("6. Keluar")
        
        pilihan = input("Pilih menu (1-6): ")
        
        if pilihan == "1":
            print("\n--- Tambah Film ---")
            id_film = input("ID Film    : ")
            judul = input("Judul Film : ")
            genre = input("Genre      : ")
            durasi = int(input("Durasi (m) : "))
            
            daftar_film.append(Film(id_film, judul, genre, durasi))
            print("Data film berhasil ditambahkan!")
            
        elif pilihan == "2":
            print("\n--- Daftar Film ---")
            if not daftar_film:
                print("Belum ada data film.")
            else:
                for idx, f in enumerate(daftar_film, 1):
                    print(f"{idx}. ID: {f.get_id()} | Judul: {f.get_judul()} | Genre: {f.get_genre()} | Durasi: {f.get_durasi()} menit")
                    
        elif pilihan == "3":
            print("\n--- Update Film ---")
            id_film = input("Masukkan ID Film yang ingin diubah: ")
            idx = cari_index_film(daftar_film, id_film)
            if idx != -1:
                judul = input("Judul Baru : ")
                genre = input("Genre Baru : ")
                durasi = int(input("Durasi Baru: "))
                
                daftar_film[idx].set_judul(judul)
                daftar_film[idx].set_genre(genre)
                daftar_film[idx].set_durasi(durasi)
                print("Data film berhasil diupdate!")
            else:
                print("Film dengan ID tersebut tidak ditemukan!")
                
        elif pilihan == "4":
            print("\n--- Hapus Film ---")
            id_film = input("Masukkan ID Film yang ingin dihapus: ")
            idx = cari_index_film(daftar_film, id_film)
            if idx != -1:
                daftar_film.pop(idx)
                print("Data film berhasil dihapus!")
            else:
                print("Film dengan ID tersebut tidak ditemukan!")
                
        elif pilihan == "5":
            print("\n--- Cari Film ---")
            id_film = input("Masukkan ID Film yang dicari: ")
            idx = cari_index_film(daftar_film, id_film)
            if idx != -1:
                f = daftar_film[idx]
                print("Data Ditemukan:")
                print(f"ID     : {f.get_id()}")
                print(f"Judul  : {f.get_judul()}")
                print(f"Genre  : {f.get_genre()}")
                print(f"Durasi : {f.get_durasi()} menit")
            else:
                print("Film dengan ID tersebut tidak ditemukan!")
                
        elif pilihan == "6":
            print("Program selesai. Terima kasih!")
            break

if __name__ == "__main__":
    main()