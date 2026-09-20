class Film:
    def __init__(self, id_film: str, judul: str, genre: str, durasi: int):
        self._id = str(id_film)
        self._judul = str(judul)
        self._genre = str(genre)
        self._durasi = int(durasi)

    # Getter
    def get_id(self) -> str:
        return self._id

    def get_judul(self) -> str:
        return self._judul

    def get_genre(self) -> str:
        return self._genre

    def get_durasi(self) -> int:
        return self._durasi

    # Setter
    def set_id(self, id_film: str) -> None:
        self._id = str(id_film)

    def set_judul(self, judul: str) -> None:
        self._judul = str(judul)

    def set_genre(self, genre: str) -> None:
        self._genre = str(genre)

    def set_durasi(self, durasi: int) -> None:
        self._durasi = int(durasi)