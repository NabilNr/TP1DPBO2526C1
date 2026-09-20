#include <iostream>
#include <string>

using namespace std;

class Film {
private:
    string id;
    string judul;
    string genre;
    int durasi; // dalam menit

public:
    Film() {}
    Film(string id, string judul, string genre, int durasi) {
        this->id = id;
        this->judul = judul;
        this->genre = genre;
        this->durasi = durasi;
    }

    // Getter
    string getId() { return id; }
    string getJudul() { return judul; }
    string getGenre() { return genre; }
    int getDurasi() { return durasi; }

    // Setter
    void setId(string id) { this->id = id; }
    void setJudul(string judul) { this->judul = judul; }
    void setGenre(string genre) { this->genre = genre; }
    void setDurasi(int durasi) { this->durasi = durasi; }

    ~Film() {}
};