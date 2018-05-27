-- id 1,3,5だけ抽出(tabelのスペルミスは許してください笑)
SELECT * FROM gs_an_tabel WHERE id=1 OR id=3 OR id=5;
-- id 4〜8を抽出
SELECT * FROM gs_an_tabel WHERE id>=4 AND id<=8;
-- email test１の曖昧抽出
SELECT * FROM gs_an_tabel WHERE email LIKE '%test1%';
-- 新しい日付順にソート
SELECT * FROM gs_an_tabel ORDER BY indate DESC;
-- age20で2017ー5−２６％の抽出
SELECT * FROM gs_an_tabel WHERE age=20 AND indate LIKE '2017-5-26%';
-- 新しい日付順で５個だけ取得
SELECT * FROM gs_an_tabel ORDER BY indate DESC LIMIT 5;
-- ageで１０〜４０がそれぞれ何人か
SELECT age, COUNT(*) FROM gs_an_tabel GROUP BY age;

