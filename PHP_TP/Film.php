<?php
class Film {
    private string $id;
    private string $judul;
    private string $genre;
    private int $durasi;
    private string $gambar; // Path file lokal gambar poster

    public function __construct(string $id, string $judul, string $genre, int $durasi, string $gambar = "uploads/poster_default.png") {
        $this->id = $id;
        $this->judul = $judul;
        $this->genre = $genre;
        $this->durasi = $durasi;
        $this->gambar = $gambar;
    }

    // Getter
    public function getId(): string { return $this->id; }
    public function getJudul(): string { return $this->judul; }
    public function getGenre(): string { return $this->genre; }
    public function getDurasi(): int { return $this->durasi; }
    public function getGambar(): string { return $this->gambar; }

    // Setter
    public function setId(string $id): void { $this->id = $id; }
    public function setJudul(string $judul): void { $this->judul = $judul; }
    public function setGenre(string $genre): void { $this->genre = $genre; }
    public function setDurasi(int $durasi): void { $this->durasi = $durasi; }
    public function setGambar(string $gambar): void { $this->gambar = $gambar; }
}
?>