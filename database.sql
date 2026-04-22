CREATE TABLE booking (
    id_booking INT AUTO_INCREMENT PRIMARY KEY,
    nama_pemesan VARCHAR(100),
    tanggal_booking DATE,
    jam_booking TIME,
    lapangan VARCHAR(50),
    status VARCHAR(20)
);
