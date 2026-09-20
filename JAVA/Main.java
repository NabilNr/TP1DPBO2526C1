import java.util.ArrayList;
import java.util.Scanner;

public class Main {
    private static int cariIndexFilm(ArrayList<Film> daftarFilm, String id) {
        for (int i = 0; i < daftarFilm.size(); i++) {
            if (daftarFilm.get(i).getId().equalsIgnoreCase(id)) {
                return i;
            }
        }
        return -1;
    }

    public static void main(String[] args) {
        ArrayList<Film> daftarFilm = new ArrayList<>();
        Scanner scanner = new Scanner(System.in);
        int pilihan = 0;

        do {
            System.out.println("\n=== SISTEM MANAJEMEN BIOSKOP (JAVA) ===");
            System.out.println("1. Tambah Data Film");
            System.out.println("2. Tampilkan Semua Film");
            System.out.println("3. Update Data Film");
            System.out.println("4. Hapus Data Film");
            System.out.println("5. Cari Data Film");
            System.out.println("6. Keluar");
            System.out.print("Pilih menu (1-6): ");
            
            pilihan = scanner.nextInt();
            scanner.nextLine(); // consume newline

            switch (pilihan) {
                case 1:
                    System.out.println("\n--- Tambah Film ---");
                    System.out.print("ID Film    : "); String id = scanner.nextLine();
                    System.out.print("Judul Film : "); String judul = scanner.nextLine();
                    System.out.print("Genre      : "); String genre = scanner.nextLine();
                    System.out.print("Durasi (m) : "); int durasi = scanner.nextInt();
                    scanner.nextLine();

                    daftarFilm.add(new Film(id, judul, genre, durasi));
                    System.out.println("Data film berhasil ditambahkan!");
                    break;

                case 2:
                    System.out.println("\n--- Daftar Film ---");
                    if (daftarFilm.isEmpty()) {
                        System.out.println("Belum ada data film.");
                    } else {
                        for (int i = 0; i < daftarFilm.size(); i++) {
                            Film f = daftarFilm.get(i);
                            System.out.println((i + 1) + ". ID: " + f.getId() +
                                    " | Judul: " + f.getJudul() +
                                    " | Genre: " + f.getGenre() +
                                    " | Durasi: " + f.getDurasi() + " menit");
                        }
                    }
                    break;

                case 3:
                    System.out.println("\n--- Update Film ---");
                    System.out.print("Masukkan ID Film yang ingin diubah: ");
                    String idUpdate = scanner.nextLine();
                    int idxUpdate = cariIndexFilm(daftarFilm, idUpdate);
                    if (idxUpdate != -1) {
                        System.out.print("Judul Baru : "); String jBaru = scanner.nextLine();
                        System.out.print("Genre Baru : "); String gBaru = scanner.nextLine();
                        System.out.print("Durasi Baru: "); int dBaru = scanner.nextInt();
                        scanner.nextLine();

                        Film f = daftarFilm.get(idxUpdate);
                        f.setJudul(jBaru);
                        f.setGenre(gBaru);
                        f.setDurasi(dBaru);
                        System.out.println("Data film berhasil diupdate!");
                    } else {
                        System.out.println("Film dengan ID tersebut tidak ditemukan!");
                    }
                    break;

                case 4:
                    System.out.println("\n--- Hapus Film ---");
                    System.out.print("Masukkan ID Film yang ingin dihapus: ");
                    String idHapus = scanner.nextLine();
                    int idxHapus = cariIndexFilm(daftarFilm, idHapus);
                    if (idxHapus != -1) {
                        daftarFilm.remove(idxHapus);
                        System.out.println("Data film berhasil dihapus!");
                    } else {
                        System.out.println("Film dengan ID tersebut tidak ditemukan!");
                    }
                    break;

                case 5:
                    System.out.println("\n--- Cari Film ---");
                    System.out.print("Masukkan ID Film yang dicari: ");
                    String idCari = scanner.nextLine();
                    int idxCari = cariIndexFilm(daftarFilm, idCari);
                    if (idxCari != -1) {
                        Film f = daftarFilm.get(idxCari);
                        System.out.println("Data Ditemukan:");
                        System.out.println("ID     : " + f.getId());
                        System.out.println("Judul  : " + f.getJudul());
                        System.out.println("Genre  : " + f.getGenre());
                        System.out.println("Durasi : " + f.getDurasi() + " menit");
                    } else {
                        System.out.println("Film dengan ID tersebut tidak ditemukan!");
                    }
                    break;
            }
        } while (pilihan != 6);

        System.out.println("Program selesai. Terima kasih!");
        scanner.close();
    }
}