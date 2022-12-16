------------------------- CATEGORIES -------------------------
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, null, 'Légumes');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, null, 'Fruits');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, null, 'Compositions');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 1, 'Légumes fleurs');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 1, 'Légumes feuilles');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 1, 'Légumes fruits');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 1, 'Légumes à bulbe');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 1, 'Légumes tubercules');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 1, 'Légumes graines');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 1, 'Légumes racine');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 1, 'Légumes tiges');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 2, 'Fruits à noyau');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 2, 'Fruits à pépin');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 2, 'Baies et fruits rouges');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 2, 'Agrumes');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 2, 'Fruits à coque');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 2, 'Fruits exotiques');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 3, 'Composition de légumes');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 3, 'Composition de fruits');
INSERT INTO Categorie
VALUES (SEQ_CATEGORIE.nextval, 3, 'Composition de légumes + fruits');


------------------------- PRODUITS -------------------------
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 6, 'Tomates Rose de Berne', 'Cagette de 2,5kg de tomates "Rose de Berne"', 2.5, 12, 1, 'Languedoc-Roussillon');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 5, 'Laitue frisée d''amérique', 'Cagette de 1kg (soit deux unités) de laitue frisée', 1, 4.5, 3, 'Normandie');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 8, 'Pomme de terre "Belle de Fontenay"', 'Cagette de 2kg de pommes de terre traditionnelles "Belle de Fontenay"', 2, 13.72, 1, 'Ile-de-France');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 8, 'Pomme de terre "Charlotte"', 'Cagette de 5kg de pommes de terre "Charlotte"', 5, 6.65, 10, 'Hauts-de-France');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 8, 'Pomme de terre "Charlotte"', 'Cagette de 5kg de pommes de terre "Charlotte"', 5, 6.65, 14, 'Bourgogne-Franche-Comté');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 8, 'Pomme de terre "Charlotte"', 'Cagette de 5kg de pommes de terre "Charlotte"', 5, 6.5, 8, 'Nouvelle-Aquitaine');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 6, 'Haricots verts filets', 'Cagette de 1.5kg de haricots verts filets extra fins', 1.5, 4.5, 2, 'Bretagne');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 10, 'Betterave crapaudine', 'Cagette de 3kg de betteraves crapaudines', 3, 7.05, 20, 'Charente-Maritime');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 10, 'Betterave potagère', 'Cagette de 4kg de betteraves rouges potagères', 4, 6.28, 47, 'Grand Est');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 10, 'Radis noir', 'Cagette de 2kg de radis noir', 2, 4.2, 12, 'Auvergne Rhône-Alpes');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 10, 'Radis noir', 'Cagette de 2kg de radis noir', 2, 4.8, 10, 'Languedoc-Roussillon');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 10, 'Radis demi-long', 'Cagette de 1.5kg de radis rouges demi-longs', 1.5, 2, 47, 'Occitanie');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 6, 'Avocat Hass', 'Cagette de 3kg d''avocats hass', 3, 15.5, 6, 'Occitanie');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 6, 'Avocat Hass', 'Cagette de 3kg d''avocats hass', 3, 15.2, 6, 'Provence-Alpes-Côte d''Azur');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 4, 'Chou-fleur', 'Cagette de 2.5kg de chou-fleur', 2.5, 10, 24, 'Bretagne');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 4, 'Chou-fleur', 'Cagette de 2kg de chou-fleur', 2, 8.5, 40, 'Grand Est');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 4, 'Chou-fleur', 'Cagette de 2.5kg de chou-fleur', 2.5, 10, 24, 'Languedoc-Roussillon');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 7, 'Ciboulette', 'Cagette de 1kg de ciboulette', 1, 5, 75, 'Occitanie');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 7, 'Oignon rouge', 'Cagette de 2kg d''oignon rouge', 2.5, 10, 15, 'Hauts-de-France');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 7, 'Échalotte grise', 'Cagette de 1kg d''échalotte grise', 2.5, 7.5, 12, 'Grand Est');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 18, 'Composition de légumes de saison (hiver)', 'Cagette de 5kg composée de carottes, betteraves, topinambours et de chou rouge', 5, 25, 5, 'Pays de la Loire');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 18, 'Composition de légumes de saison (hiver)', 'Cagette de 5kg composée de carottes, betteraves, topinambours et de chou rouge', 5, 25, 5, 'Centre-Val de Loire');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 18, 'Composition de légumes de saison (hiver)', 'Cagette de 6kg composée de carottes, betteraves, rutabagas, poireaux et d''artichauts', 6, 32, 3, 'Normandie');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 19, 'Composition de fruits de saison (hiver)', 'Cagette de 3kg composée de mandarines, poires, clémentines, et litchis', 3, 18, 10, 'Occitanie');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 19, 'Composition de fruits de saison (hiver)', 'Cagette de 3kg composée de mandarines, poires, clémentines, et litchis', 3, 21, 52, 'Ile de France');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 19, 'Composition de fruits de saison (hiver)', 'Cagette de 5kg composée de mandarines, poires, pommes, kiwis et clémentines', 5, 25, 25, 'Bourgogne-Franche-Comté');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 20, 'Composition de fruits et de légumes de saison (hiver)', 'Cagette de 8kg composée de mandarines,clémentines, rutabagas, betteraves et de carottes', 8, 46, 12, 'Normandie');
INSERT INTO Produit
VALUES (SEQ_Produit.nextval, 20, 'Composition de fruits et de légumes de saison (hiver)', 'Cagette de 7kg composée de poires, pommes, poireaux, betteraves et de carottes', 7, 40, 5, 'Nouvelle-Aquitaine');


------------------------- CLIENTS -------------------------
insert into Client values (SEQ_Client.nextval, 'Ricart', 'Corney', 'cricart2@foxnews.com', '$2y$10$kWe2jW2WTtiLVT.pGwaWHO5Y1CGOtn.cDH3c0tKR6ZmbVKTc5AgOG', 1);
insert into Client values (SEQ_Client.nextval, 'Vynehall', 'Catlee', 'cvynehall3@columbia.edu', '$2y$10$JpzmPHNtKsfecM5ezlf7Zu3skpIdN.w6G/aGFn/wxK7hi/Qrpr7Fa', 0);
insert into Client values (SEQ_Client.nextval, 'Fishpond', 'Tuesday', 'tfishpond4@usnews.com', '$2y$10$qRSjhn5.kwJ1x9Q.rHIKx.sAsg9l8uT52E1J4/wYhqoO/oOVo6s1G', 0);
insert into Client values (SEQ_Client.nextval, 'Ower', 'Billie', 'bower5@google.cn', '$2y$10$k47EK0Jvk0mPlXkBg2hcM.KM6aHWk/yIFw4GKhkYsb48/Z1zqObn2', 0);
insert into Client values (SEQ_Client.nextval, 'Scolding', 'Datha', 'dscolding6@ow.ly', '$2y$10$ob2myIl3Z/RVp0gJTa8hke/wXEgHkj9KJ4QKgmKueB8jZXbhyqRWK', 0);
insert into Client values (SEQ_Client.nextval, 'Alebrooke', 'Terrel', 'talebrooke7@pbs.org', '$2y$10$5R6audHqxLwFEhFp7aIldu6/I/LsiSw1cWBpwYUgMstN/ciH6aGde', 0);
insert into Client values (SEQ_Client.nextval, 'Raggatt', 'Eugenio', 'eraggatt8@nhs.uk', '$2y$10$KTFk3YkgrNcuIUzgIf8KUOd7EyBvFpoicEItDZqsW8fgR4aWsDjvi', 1);
insert into Client values (SEQ_Client.nextval, 'Gunby', 'Silvia', 'sgunby9@nytimes.com', '$2y$10$t4fvvhUL43O7Hal5KQYpY.N0gD0b2UvIISBfTlRVfGxhGHOB1gvoq', 0);
insert into Client values (SEQ_Client.nextval, 'Murrock', 'Leigh', 'lmurrocka@odnoklassniki.ru', '$2y$10$sV2f4dCLrtVyTHRqiOp39OWOlcNi.Pqi7L9ZhVuD8rD2Eulh7lsT.', 0);
insert into Client values (SEQ_Client.nextval, 'Furse', 'Wayne', 'wfurseb@surveymonkey.com', '$2y$10$9IwutawOuyYHUnLGUO7EC.HmBdIz.T6bflMUiIzl7JgFW7GD2JJXS', 1);
insert into Client values (SEQ_Client.nextval, 'Gregol', 'Renelle', 'rgregolc@fda.gov', '$2y$10$/JFKwUce6nQ1pHX97WNDOeB8wz2/5jiFfXgCGu8KqZ0BclVyK.hd.', 0);
insert into Client values (SEQ_Client.nextval, 'Wiffler', 'Flinn', 'fwifflerd@tamu.edu', '$2y$10$jvl27sxTLERoYQX5wb1Ek.9HlURpTctooUnqQzteSChAI37Q3JW8.', 0);
insert into Client values (SEQ_Client.nextval, 'Karpinski', 'Jessica', 'jkarpinskie@hugedomains.com', '$2y$10$2ABXtaKyFl6jKvstgC.of.il.ysNRpohAqv5vsXUXKvOAKR/luef6', 0);
insert into Client values (SEQ_Client.nextval, 'Mossdale', 'Judi', 'jmossdalef@cdc.gov', '$2y$10$BrLmOfx8eWVjNsifDAOcZe9gydD0mKnq2aov/PQ5Ghs8Ab0FObKEq', 1);
insert into Client values (SEQ_Client.nextval, 'Baile', 'Darda', 'dbaileg@usatoday.com', '$2y$10$aCUOpDzz3QMgrjiurGi1.uPhKVaXXf2GzN0TT.l.kIylQC.cYB/VW', 0);
insert into Client values (SEQ_Client.nextval, 'Heading', 'Daisi', 'dheadingh@columbia.edu', '$2y$10$4n/ZXsEfzEs0Ld4McgdJmONlzLc6vOXfHfrXsopQuV7BDIAkjn9Y2', 0);
insert into Client values (SEQ_Client.nextval, 'Spencers', 'Lorrayne', 'lspencersi@dailymail.co.uk', '$2y$10$Jk.x2Gk/EtEmap3l4wzocO.i/JG.g6266JRq/lArsyjh0h3R.xEre', 0);
insert into Client values (SEQ_Client.nextval, 'MacKilroe', 'Sampson', 'smackilroej@nature.com', '$2y$10$7U8U6K4pPE.3l5MGsVDywOPzfpcs5OGeFmOk.W89QmnHAfvOxCtpe', 0);
insert into Client values (SEQ_Client.nextval, 'Millin', 'Emalia', 'emillink@narod.ru', '$2y$10$JxvA0usogfA80GEUZjKoOe4WwGYj6uCu7k5S0qa7N2IOjt04m6SB2', 0);
insert into Client values (SEQ_Client.nextval, 'Broomhall', 'Maxy', 'mbroomhalll@dailymail.co.uk', '$2y$10$LY59MRL3TStq8HZmioYhM.yikuqv6OKvoIUWLoB/fdb.4m3gQnOri', 0);
insert into Client values (SEQ_Client.nextval, 'Guyan', 'Leroy', 'lguyanm@nationalgeographic.com', '$2y$10$YdTdWdxCbS0KabYwJO/OSO1cqXMUNjWcmCxVCJfv2.PXQ0j4RKLxO', 0);
insert into Client values (SEQ_Client.nextval, 'Lerohan', 'Rafaello', 'rlerohann@biblegateway.com', '$2y$10$IAFlp4XyGcUwrjmIdQcTQu8K4pgnzBsYikkMDNtJ2VtKeAdDg1xNe', 0);
insert into Client values (SEQ_Client.nextval, 'Widmoor', 'Talbert', 'twidmooro@google.ru', '$2y$10$BJugmYpy81z99dN8as6/LehOk/Lp7Lbo.FUshiD02vqvLvtp.xAyi', 0);
insert into Client values (SEQ_Client.nextval, 'Polack', 'Jenica', 'jpolackp@etsy.com', '$2y$10$oF9sglAu2Em38XepHbODr.P9lg7sCchGzj49aAArZpbfY5sV5gAHO', 0);
insert into Client values (SEQ_Client.nextval, 'Cawsby', 'Zarah', 'zcawsbyq@so-net.ne.jp', '$2y$10$3fOfKsPki.rO40h/g/do2.h.7WinOn/6zmVIcSoJmpzerQ7UTPugu', 0);
insert into Client values (SEQ_Client.nextval, 'Dagwell', 'Brodie', 'bdagwellr@reverbnation.com', '$2y$10$57TNuVD.dvXuIsjmb/53Suis6kruR1IdBsEEXgywhEfnTrikUDVWK', 1);
insert into Client values (SEQ_Client.nextval, 'Stutter', 'Calvin', 'cstutters@acquirethisname.com', '$2y$10$4LqATnYOBg8hF6mgEqd03.UwqgicDxcCSFH.xaD9chO.SuC2hwKl2', 0);
insert into Client values (SEQ_Client.nextval, 'Dober', 'Lorin', 'ldobert@yellowpages.com', '$2y$10$GyWDkNvejfASG6rbwDRGzuIIgENZnflOTiiFtkavWaqOZ9wVWWyJi', 0);
insert into Client values (SEQ_Client.nextval, 'Roberson', 'Otha', 'orobersonu@europa.eu', '$2y$10$z9r7DxmW5FAo4X6u7fyAI.o.e63BzSMRs4OcOZoWim4y9/LISVniu', 0);
insert into Client values (SEQ_Client.nextval, 'Arnoll', 'Costanza', 'carnollv@unc.edu', '$2y$10$VeaqTlLQh7qwDlSCQEXJueEVIPS7EA6niUo9rMW5ZXg7Rny1y9E0.', 0);
insert into Client values (SEQ_Client.nextval, 'MacBarron', 'Zara', 'zmacbarronw@forbes.com', '$2y$10$zS72TNZNtHstv64RQHgn2et/UzgqJYlBhnWZtydCPvnlalsJO/d3e', 0);
insert into Client values (SEQ_Client.nextval, 'Padgham', 'Ambros', 'apadghamx@nationalgeographic.com', '$2y$10$v4xpPdTeva8pMMfWfdJbDeu1cqS5Jg3vilHc.7cIT9tKGs6WZsqWq', 0);
insert into Client values (SEQ_Client.nextval, 'Darnbrook', 'Debera', 'ddarnbrooky@ebay.com', '$2y$10$Pf3bmeJZBQEvMHjb6k.dgOjMt3/OtIv/DkDcYMlYJMOeeeRlmbWHO', 0);
insert into Client values (SEQ_Client.nextval, 'Fiveash', 'Clemence', 'cfiveashz@vistaprint.com', '$2y$10$jsP2eaQar0cyteFASGOnv.leOkbovjQ0zGObJXlHFw1zXvQBTzBSy', 0);
insert into Client values (SEQ_Client.nextval, 'Yvens', 'Sharline', 'syvens10@icq.com', '$2y$10$JqK5hQkecuxU6Tm1YnPZLOUWFCoiuxu.MZwl3HBEmFbDzoVRF5vf.', 1);
insert into Client values (SEQ_Client.nextval, 'Snaith', 'Ruperto', 'rsnaith11@zimbio.com', '$2y$10$/GDjwL/H655olMvVMQXOVuLzJV0jzHng1ko1f7tb.7d8mBETPnBYG', 1);
insert into Client values (SEQ_Client.nextval, 'Pedrollo', 'Melissa', 'mpedrollo12@mozilla.org', '$2y$10$U3t4g1t8WnbM/3W3ciaGGuBKZx9LuR0cGlc6pcsH8ujHjAXxD4RD6', 0);
insert into Client values (SEQ_Client.nextval, 'Thatcham', 'Tracy', 'tthatcham13@irs.gov', '$2y$10$mRbYUxTx4aOCTvHYDeLVT.QOXtYHLnbubsBNHl4FUQWvJlwy0GJO.', 1);
insert into Client values (SEQ_Client.nextval, 'Maryott', 'Fred', 'fmaryott14@csmonitor.com', '$2y$10$MJRo9TnKP8Isbm9LU6DQP.itjKs5iJn04oaV3/4tEMYKD.VQ/WTaO', 0);
insert into Client values (SEQ_Client.nextval, 'Wimbridge', 'Florinda', 'fwimbridge15@stumbleupon.com', '$2y$10$hJKR8hcsJ0BryAWqADd1ceCDQnSZn82.rD5oBkXARxwcjmOd6RIHK', 0);
insert into Client values (SEQ_Client.nextval, 'Cahan', 'Melisande', 'mcahan16@furl.net', '$2y$10$0GL2iohmc10AZap4Imu1a.ZES3NBl9yFRkUgOWas7SFLRe3gVQr72', 0);
insert into Client values (SEQ_Client.nextval, 'Poschel', 'Derick', 'dposchel17@yahoo.co.jp', '$2y$10$qJ/7CCvuBTwjdW2fRIa21.rIwDQTzdULUNgZqWZdN4.UMhzV.Al0i', 0);
insert into Client values (SEQ_Client.nextval, 'Bansal', 'Niven', 'nbansal18@artisteer.com', '$2y$10$5sk9SUZqK/YfoKXKySHYtegL1wxYXeHgmx4sQglaRIpDFdnQlDTUe', 0);
insert into Client values (SEQ_Client.nextval, 'Titterrell', 'Hazlett', 'htitterrell19@geocities.jp', '$2y$10$ZpKi5WXfd9WrA16QIV2LD.AydjhXgQnIBVCeruA7lTCHJvnNF0oLm', 0);
insert into Client values (SEQ_Client.nextval, 'Ruffles', 'Dotty', 'druffles1a@microsoft.com', '$2y$10$xKRn7K/8tctvK6.eerb/xuxROK8Y6tbFviHnAq0GPJBl/yCoNi3e2', 1);
insert into Client values (SEQ_Client.nextval, 'Reap', 'Allister', 'areap1b@bloglovin.com', '$2y$10$4RhPdCcDBKN2M78KIalzWOQHRfebCootKSoR.fVazLMZmtoxAPy9O', 0);
insert into Client values (SEQ_Client.nextval, 'Hawtry', 'Morganica', 'mhawtry1c@seattletimes.com', '$2y$10$84X07SKvIdCXDTPGqesChub7GoQ0rGFJJeLN4SjzQxR2tjOhzIjhG', 0);
insert into Client values (SEQ_Client.nextval, 'Vaux', 'Nevile', 'nvaux1d@mashable.com', '$2y$10$FzH06joHOdBaQued6R1MXexhFShgPAJz/dbTmT36LW3xoo4sqVZ0y', 1);
insert into Client values (SEQ_Client.nextval, 'Ellissen', 'Kirby', 'kellissen1@devhub.com', '$2y$10$7siAaZDzUTQry3uZvYv.B.Y6fmBegX1LKW215ghERAcDgd2g8oBkO', 0);


------------------------- PANIERS -------------------------
INSERT INTO Panier
VALUES (10, 5, 1);

INSERT INTO Panier
VALUES (1, 24, 20);

INSERT INTO Panier
VALUES (14, 7, 11);

INSERT INTO Panier
VALUES (28, 21, 28);

INSERT INTO Panier
VALUES (43, 25, 36);

INSERT INTO Panier
VALUES (27, 15, 17);

INSERT INTO Panier
VALUES (37, 11, 7);

INSERT INTO Panier
VALUES (5, 17, 4);

INSERT INTO Panier
VALUES (46, 4, 44);

INSERT INTO Panier
VALUES (12, 9, 24);


------------------------- REGLEMENTS -------------------------
INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);

INSERT INTO Reglement
VALUES (SEQ_REGLEMENT.nextval);


------------------------- CARTES BANCAIRES -------------------------
INSERT INTO CarteBancaire
VALUES (5, 5438426737333343, 509, 08, 2023);
INSERT INTO CarteBancaire
VALUES (8, 5557522242247948, 144, 03, 2025);
INSERT INTO CarteBancaire
VALUES (9, 5386549426343166, 226, 10, 2025);
INSERT INTO CarteBancaire
VALUES (7, 5468524997548593, 477, 10, 2024);
INSERT INTO CarteBancaire
VALUES (3, 5165444835636870, 467, 10, 2024);
INSERT INTO CarteBancaire
VALUES (6, 5547228121343575, 288, 09, 2022);
INSERT INTO CarteBancaire
VALUES (23, 4024007194533, 114, 06, 2022);
INSERT INTO CarteBancaire
VALUES (4, 4716185121444826, 321, 09, 2025);
INSERT INTO CarteBancaire
VALUES (2, 4556384887668, 899, 12, 2024);
INSERT INTO CarteBancaire
VALUES (17, 5427598326185285, 441, 06, 2022);


------------------------- PAYPAL -------------------------
INSERT INTO PAYPAL
VALUES(1);
INSERT INTO PAYPAL
VALUES(10);
INSERT INTO PAYPAL
VALUES(11);
INSERT INTO PAYPAL
VALUES(12);
INSERT INTO PAYPAL
VALUES(13);
INSERT INTO PAYPAL
VALUES(14);
INSERT INTO PAYPAL
VALUES(15);
INSERT INTO PAYPAL
VALUES(16);
INSERT INTO PAYPAL
VALUES(18);
INSERT INTO PAYPAL
VALUES(19);
INSERT INTO PAYPAL
VALUES(20);
INSERT INTO PAYPAL
VALUES(21);
INSERT INTO PAYPAL
VALUES(22);
INSERT INTO PAYPAL
VALUES(24);
INSERT INTO PAYPAL
VALUES(25);
INSERT INTO PAYPAL
VALUES(26);
INSERT INTO PAYPAL
VALUES(27);
INSERT INTO PAYPAL
VALUES(28);
INSERT INTO PAYPAL
VALUES(29);
INSERT INTO PAYPAL
VALUES(30);
INSERT INTO PAYPAL
VALUES(31);
INSERT INTO PAYPAL
VALUES(32);
INSERT INTO PAYPAL
VALUES(33);
INSERT INTO PAYPAL
VALUES(34);
INSERT INTO PAYPAL
VALUES(35);
INSERT INTO PAYPAL
VALUES(36);
INSERT INTO PAYPAL
VALUES(37);
INSERT INTO PAYPAL
VALUES(38);
INSERT INTO PAYPAL
VALUES(39);
INSERT INTO PAYPAL
VALUES(40);
INSERT INTO PAYPAL
VALUES(41);
INSERT INTO PAYPAL
VALUES(42);
INSERT INTO PAYPAL
VALUES(43);
INSERT INTO PAYPAL
VALUES(44);
INSERT INTO PAYPAL
VALUES(45);
INSERT INTO PAYPAL
VALUES(46);
INSERT INTO PAYPAL
VALUES(47);
INSERT INTO PAYPAL
VALUES(48);
INSERT INTO PAYPAL
VALUES(49);
INSERT INTO PAYPAL
VALUES(50);
INSERT INTO PAYPAL
VALUES(51);
INSERT INTO PAYPAL
VALUES(52);
INSERT INTO PAYPAL
VALUES(53);
INSERT INTO PAYPAL
VALUES(54);
INSERT INTO PAYPAL
VALUES(55);
INSERT INTO PAYPAL
VALUES(56);
INSERT INTO PAYPAL
VALUES(57);
INSERT INTO PAYPAL
VALUES(58);
INSERT INTO PAYPAL
VALUES(59);
INSERT INTO PAYPAL
VALUES(60);
INSERT INTO PAYPAL
VALUES(61);
INSERT INTO PAYPAL
VALUES(62);
INSERT INTO PAYPAL
VALUES(63);
INSERT INTO PAYPAL
VALUES(64);
INSERT INTO PAYPAL
VALUES(65);
INSERT INTO PAYPAL
VALUES(66);
INSERT INTO PAYPAL
VALUES(67);
INSERT INTO PAYPAL
VALUES(68);
INSERT INTO PAYPAL
VALUES(69);
INSERT INTO PAYPAL
VALUES(70);
INSERT INTO PAYPAL
VALUES(71);
INSERT INTO PAYPAL
VALUES(72);
INSERT INTO PAYPAL
VALUES(73);
INSERT INTO PAYPAL
VALUES(74);
INSERT INTO PAYPAL
VALUES(75);
INSERT INTO PAYPAL
VALUES(76);
INSERT INTO PAYPAL
VALUES(77);
INSERT INTO PAYPAL
VALUES(78);
INSERT INTO PAYPAL
VALUES(79);
INSERT INTO PAYPAL
VALUES(80);
INSERT INTO PAYPAL
VALUES(81);
INSERT INTO PAYPAL
VALUES(82);
INSERT INTO PAYPAL
VALUES(83);
INSERT INTO PAYPAL
VALUES(84);
INSERT INTO PAYPAL
VALUES(85);
INSERT INTO PAYPAL
VALUES(86);
INSERT INTO PAYPAL
VALUES(87);
INSERT INTO PAYPAL
VALUES(88);
INSERT INTO PAYPAL
VALUES(89);
INSERT INTO PAYPAL
VALUES(90);
INSERT INTO PAYPAL
VALUES(91);
INSERT INTO PAYPAL
VALUES(92);
INSERT INTO PAYPAL
VALUES(93);
INSERT INTO PAYPAL
VALUES(94);
INSERT INTO PAYPAL
VALUES(95);
INSERT INTO PAYPAL
VALUES(96);
INSERT INTO PAYPAL
VALUES(97);
INSERT INTO PAYPAL
VALUES(98);
INSERT INTO PAYPAL
VALUES(99);
INSERT INTO PAYPAL
VALUES(100);


------------------------- COMMANDES -------------------------
INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 17, 1, '7604 Rutrum. Rd.', 'Saintes', '84585');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 6, 2, '377 Magna. Rd.', 'Limoges', '24553');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 43, 3, 'P.O. Box 149,  6068 Sed,  Av.', 'Talence', '48356');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 20, 4, '540-4492 Nec,  St.', 'Colomiers', '10287');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 12, 5, 'Ap #419-5043 Blandit Rd.', 'Creil', '81876');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 13, 6, '606-8580 Magnis Av.', 'Brive-la-Gaillarde', '39589');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 12, 7, 'P.O. Box 875,  8428 A,  Ave', 'Nîmes', '19261');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 32, 8, 'Ap #417-5367 Convallis Rd.', 'Castres', '45835');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 40, 9, 'Ap #599-2391 Laoreet St.', 'Caen', '94126');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 3, 10, '7670 Pede Rd.', 'Creil', '55174');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 5, 11, 'Ap #870-474 Et,  Rd.', 'Besançon', '98778');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 33, 12, '450-3236 Malesuada Ave', 'Béziers', '47461');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 15, 13, '464-9652 Lacinia. Street', 'Narbonne', '81311');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 23, 14, '118-2377 Posuere St.', 'Bergerac', '53236');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 33, 15, '442-237 Fermentum Ave', 'Cherbourg-Octeville', '15236');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 3, 16, '244-798 Ornare St.', 'Saint-Quentin', '05754');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 34, 17, 'Ap #605-3577 Sed Ave', 'Versailles', '54597');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 38, 18, '881-6966 Mus. Rd.', 'Boulogne-sur-Mer', '39942');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 7, 19, 'P.O. Box 777,  1080 Pellentesque Street', 'Bègles', '11887');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 27, 20, 'P.O. Box 505,  5739 Non St.', 'Mont-de-Marsan', '13745');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 43, 21, 'Ap #305-9417 In,  Rd.', 'Clermont-Ferrand', '75844');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 13, 22, '955-2234 Vitae,  Av.', 'Dijon', '30644');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 3, 23, '846-8939 Sollicitudin Ave', 'Mérignac', '35233');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 46, 24, 'Ap #647-5834 Molestie St.', 'Courbevoie', '98326');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 35, 25, '445-9979 Malesuada. St.', 'Montigny-lès-Metz', '20866');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 30, 26, 'Ap #435-3680 Quam Road', 'Aurillac', '16763');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 5, 27, '302-5197 Eu,  Rd.', 'Valenciennes', '85756');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 23, 28, '183-3935 Ultrices Avenue', 'Martigues', '97584');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 18, 29, 'Ap #536-2839 Nam Street', 'Ajaccio', '50985');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 27, 30, '965-1441 Eget,  St.', 'Ajaccio', '86545');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 4, 31, 'P.O. Box 540,  7783 Quam. Rd.', 'Beauvais', '19031');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 39, 32, '5536 Velit Av.', 'Montbéliard', '08716');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 49, 33, '3380 Pellentesque St.', 'Fréjus', '52103');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 12, 34, 'P.O. Box 896,  9992 A Street', 'Brive-la-Gaillarde', '47623');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 21, 35, '7284 Commodo Rd.', 'Saint-Dizier', '78759');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 46, 36, 'P.O. Box 381,  4250 Sagittis. Road', 'Pontarlier', '15914');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 44, 37, '6244 Neque. St.', 'Nantes', '78018');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 26, 38, 'P.O. Box 519,  9030 A Avenue', 'Saintes', '64013');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 42, 39, '9934 Auctor,  Road', 'Aubagne', '34528');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 33, 40, 'Ap #575-6330 Eget,  Avenue', 'Ajaccio', '26705');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 31, 41, 'Ap #311-5044 Quisque Road', 'Auxerre', '23542');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 25, 42, '747-2719 Netus Avenue', 'Bayonne', '90493');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 3, 43, 'Ap #241-7351 Leo. St.', 'Chalon-sur-Saône', '27242');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 19, 44, 'P.O. Box 450,  733 Augue Av.', 'Rouen', '17731');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 30, 45, '489-9678 Scelerisque Road', 'Saint-Malo', '42428');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 45, 46, 'Ap #342-4158 Feugiat Road', 'Vernon', '53453');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 11, 47, 'Ap #146-1466 Nulla St.', 'Ajaccio', '23207');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 2, 48, 'P.O. Box 691,  6101 Ut Rd.', 'Strasbourg', '60724');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 2, 49, 'P.O. Box 829,  1889 Suspendisse Av.', 'Belfort', '66114');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 13, 50, 'P.O. Box 477,  8286 Dictum Rd.', 'Limoges', '85794');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 43, 51, 'Ap #939-1302 Ipsum St.', 'Martigues', '52157');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 29, 52, 'Ap #658-9594 Dolor. Rd.', 'Vierzon', '74572');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 27, 53, 'Ap #558-2406 Mauris Avenue', 'Metz', '81139');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 45, 54, '117-7080 Et,  Avenue', 'Castres', '21733');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 16, 55, 'Ap #973-4842 Gravida Avenue', 'Caen', '12473');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 30, 56, '9159 Urna St.', 'Schiltigheim', '63660');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 36, 57, 'Ap #751-968 Blandit Avenue', 'Tours', '63267');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 7, 58, 'Ap #334-8827 Quam St.', 'Béziers', '62475');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 16, 59, '2517 Nulla. Avenue', 'Strasbourg', '38477');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 12, 60, 'Ap #750-1504 Aliquam Rd.', 'Angoulême', '08555');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 35, 61, '896-5282 Cursus Rd.', 'Beauvais', '11197');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 42, 62, 'P.O. Box 212,  5464 Aliquam St.', 'Montluçon', '05251');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 9, 63, '729-2541 Facilisi. Rd.', 'Brive-la-Gaillarde', '13188');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 19, 64, '219-6652 Ligula. St.', 'Villeneuve-d''Ascq', '81518');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 16, 65, 'Ap #138-7295 Magna Rd.', 'Joué-lès-Tours', '41869');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 31, 66, '439-7341 Pede. Rd.', 'Brive-la-Gaillarde', '83542');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 40, 67, 'P.O. Box 803,  3603 Risus. Road', 'Ajaccio', '28112');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 22, 68, 'Ap #332-7791 Blandit Rd.', 'Le Mans', '10216');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 25, 69, '674-8388 Vel Road', 'Saint-Herblain', '44599');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 39, 70, '378-4909 Id St.', 'Rouen', '33225');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 37, 71, '8690 Nisi Avenue', 'Cannes', '77333');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 19, 72, 'P.O. Box 418,  4306 Consequat Ave', 'Bastia', '37568');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 5, 73, '272-8149 Eu St.', 'Ajaccio', '16281');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 38, 74, '710-9436 Nulla. Avenue', 'Troyes', '65285');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 49, 75, '9276 Ante Ave', 'Chartres', '26211');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 7, 76, '835-8974 Nec,  Av.', 'Mâcon', '22324');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 17, 77, '391-3359 Praesent St.', 'Marcq-en-Baroeul', '07398');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 3, 78, 'Ap #380-4298 Sed Rd.', 'Vannes', '88718');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 22, 79, 'Ap #997-6126 Aliquam Rd.', 'Draguignan', '73387');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 48, 80, 'P.O. Box 464,  6474 Non,  St.', 'Istres', '23751');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 30, 81, 'P.O. Box 614,  7338 At St.', 'Niort', '68474');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 1, 82, '741-7731 Convallis Street', 'Lunel', '77391');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 40, 83, 'Ap #109-3936 Eu Street', 'Bergerac', '74727');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 7, 84, 'Ap #277-6097 Magnis Ave', 'Le Havre', '69466');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 25, 85, 'P.O. Box 522,  3264 Quam Rd.', 'Le Cannet', '19858');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 27, 86, '288-5305 Aliquam St.', 'Besançon', '97421');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 49, 87, 'Ap #778-5551 Auctor Road', 'La Roche-sur-Yon', '30205');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 17, 88, '7093 Lorem Rd.', 'Montauban', '61364');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 10, 89, 'Ap #166-8330 Malesuada Ave', 'Drancy', '83102');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 44, 90, '9876 Justo Rd.', 'Saintes', '18169');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 26, 91, '151-4871 Nisl. Rd.', 'Biarritz', '68087');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 6, 92, 'Ap #638-5939 Phasellus Ave', 'Montbéliard', '63328');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 41, 93, 'Ap #932-8245 Ultrices. Rd.', 'Lunel', '67312');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 25, 94, 'P.O. Box 634,  6854 Mus. Ave', 'Aubagne', '17801');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 3, 95, '638-7432 At Rd.', 'Joué-lès-Tours', '00124');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 27, 96, 'Ap #211-8300 Lacus. St.', 'Montluçon', '27198');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 4, 97, 'Ap #741-2706 Adipiscing Rd.', 'Saint-Quentin', '39351');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 38, 98, '234-6927 Mi. Rd.', 'Le Havre', '72443');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 36, 99, 'Ap #184-4139 Aenean Rd.', 'Rezé', '86261');

INSERT INTO Commande 
VALUES (SEQ_Commande.nextval, 16, 100, 'Ap #497-5732 Tincidunt Avenue', 'Saint-Médard-en-Jalles', '62360');


------------------------- QUANTITES COMMANDEES -------------------------
INSERT INTO Quantite
VALUES (12, 1, 5, 6);
INSERT INTO Quantite
VALUES (2, 1, 9, 4.5);
INSERT INTO Quantite
VALUES (26, 1, 41, 12);
INSERT INTO Quantite
VALUES (6, 1, 29, 6.5);
INSERT INTO Quantite
VALUES (9, 1, 6, 10);
INSERT INTO Quantite
VALUES (19, 2, 38, 5);
INSERT INTO Quantite
VALUES (26, 2, 25, 9);
INSERT INTO Quantite
VALUES (5, 2, 5, 1);
INSERT INTO Quantite
VALUES (11, 2, 38, 12);
INSERT INTO Quantite
VALUES (28, 2, 31, 12);
INSERT INTO Quantite
VALUES (13, 3, 22, 3);
INSERT INTO Quantite
VALUES (20, 3, 43, 9);
INSERT INTO Quantite
VALUES (5, 3, 40, 3);
INSERT INTO Quantite
VALUES (3, 3, 25, 7);
INSERT INTO Quantite
VALUES (10, 3, 21, 11);
INSERT INTO Quantite
VALUES (13, 4, 22, 3);
INSERT INTO Quantite
VALUES (20, 4, 43, 9);
INSERT INTO Quantite
VALUES (5, 4, 40, 3);
INSERT INTO Quantite
VALUES (3, 4, 25, 7);
INSERT INTO Quantite
VALUES (10, 4, 21, 11);
INSERT INTO Quantite
VALUES (13, 5, 22, 3);
INSERT INTO Quantite
VALUES (20, 5, 43, 9);
INSERT INTO Quantite
VALUES (5, 5, 40, 3);
INSERT INTO Quantite
VALUES (3, 5, 25, 7);
INSERT INTO Quantite
VALUES (10, 5, 21, 11);
INSERT INTO Quantite
VALUES (9, 6, 30, 3);
INSERT INTO Quantite
VALUES (28, 6, 38, 5);
INSERT INTO Quantite
VALUES (17, 6, 16, 9);
INSERT INTO Quantite
VALUES (19, 6, 15, 3);
INSERT INTO Quantite
VALUES (16, 6, 3, 4);
INSERT INTO Quantite
VALUES (18, 7, 28, 5);
INSERT INTO Quantite
VALUES (3, 7, 42, 9);
INSERT INTO Quantite
VALUES (2, 7, 9, 11);
INSERT INTO Quantite
VALUES (13, 7, 16, 4);
INSERT INTO Quantite
VALUES (20, 7, 50, 3);
INSERT INTO Quantite
VALUES (6, 8, 44, 10);
INSERT INTO Quantite
VALUES (26, 8, 31, 5);
INSERT INTO Quantite
VALUES (4, 8, 30, 4);
INSERT INTO Quantite
VALUES (5, 8, 5, 7);
INSERT INTO Quantite
VALUES (26, 41, 36, 5);
INSERT INTO Quantite
VALUES (27, 9, 44, 11);
INSERT INTO Quantite
VALUES (28, 9, 42, 5);
INSERT INTO Quantite
VALUES (10, 9, 28, 11);
INSERT INTO Quantite
VALUES (7, 9, 44, 5);
INSERT INTO Quantite
VALUES (19, 9, 27, 2);
INSERT INTO Quantite
VALUES (5, 10, 47, 5);
INSERT INTO Quantite
VALUES (6, 10, 7, 4);
INSERT INTO Quantite
VALUES (22, 10, 10, 2);
INSERT INTO Quantite
VALUES (20, 10, 6, 8);
INSERT INTO Quantite
VALUES (28, 10, 47, 10);
INSERT INTO Quantite
VALUES (21, 11, 18, 7);
INSERT INTO Quantite
VALUES (2, 11, 21, 1);
INSERT INTO Quantite
VALUES (28, 11, 11, 3);
INSERT INTO Quantite
VALUES (22, 11, 18, 9);
INSERT INTO Quantite
VALUES (10, 11, 45, 12);
INSERT INTO Quantite
VALUES (10, 12, 26, 11);
INSERT INTO Quantite
VALUES (17, 12, 11, 1);
INSERT INTO Quantite
VALUES (16, 12, 11, 7);
INSERT INTO Quantite
VALUES (28, 12, 40, 4);
INSERT INTO Quantite
VALUES (3, 12, 28, 3);
INSERT INTO Quantite
VALUES (11, 13, 44, 8);
INSERT INTO Quantite
VALUES (8, 13, 14, 11);
INSERT INTO Quantite
VALUES (15, 13, 12, 4);
INSERT INTO Quantite
VALUES (28, 13, 48, 5);
INSERT INTO Quantite
VALUES (1, 13, 9, 3);
INSERT INTO Quantite
VALUES (11, 14, 44, 8);
INSERT INTO Quantite
VALUES (8, 14, 14, 11);
INSERT INTO Quantite
VALUES (15, 14, 12, 4);
INSERT INTO Quantite
VALUES (28, 14, 48, 5);
INSERT INTO Quantite
VALUES (1, 14, 9, 3);
INSERT INTO Quantite
VALUES (26, 15, 7, 12);
INSERT INTO Quantite
VALUES (25, 15, 35, 5);
INSERT INTO Quantite
VALUES (19, 15, 39, 10);
INSERT INTO Quantite
VALUES (28, 15, 35, 10);
INSERT INTO Quantite
VALUES (19, 25, 29, 1);
INSERT INTO Quantite
VALUES (19, 16, 23, 2);
INSERT INTO Quantite
VALUES (9, 16, 4, 8);
INSERT INTO Quantite
VALUES (28, 16, 47, 9);
INSERT INTO Quantite
VALUES (5, 16, 39, 11);
INSERT INTO Quantite
VALUES (19, 11, 41, 5);
INSERT INTO Quantite
VALUES (16, 17, 45, 6);
INSERT INTO Quantite
VALUES (19, 17, 19, 10);
INSERT INTO Quantite
VALUES (19, 18, 16, 8);
INSERT INTO Quantite
VALUES (15, 17, 32, 2);
INSERT INTO Quantite
VALUES (7, 17, 14, 10);
INSERT INTO Quantite
VALUES (26, 18, 47, 5);
INSERT INTO Quantite
VALUES (16, 18, 11, 2);
INSERT INTO Quantite
VALUES (12, 18, 44, 8);
INSERT INTO Quantite
VALUES (16, 20, 23, 9);
INSERT INTO Quantite
VALUES (7, 18, 36, 12);
INSERT INTO Quantite
VALUES (26, 19, 45, 3);
INSERT INTO Quantite
VALUES (14, 19, 18, 5);
INSERT INTO Quantite
VALUES (19, 19, 20, 9);
INSERT INTO Quantite
VALUES (4, 19, 46, 2);
INSERT INTO Quantite
VALUES (16, 19, 9, 11);
INSERT INTO Quantite
VALUES (5, 20, 43, 11);
INSERT INTO Quantite
VALUES (12, 20, 42, 10);
INSERT INTO Quantite
VALUES (13, 20, 46, 6);
INSERT INTO Quantite
VALUES (19, 20, 32, 5);
INSERT INTO Quantite
VALUES (3, 20, 45, 10);
INSERT INTO Quantite
VALUES (14, 21, 26, 10);
INSERT INTO Quantite
VALUES (13, 21, 6, 9);
INSERT INTO Quantite
VALUES (11, 21, 14, 6);
INSERT INTO Quantite
VALUES (5, 21, 35, 2);
INSERT INTO Quantite
VALUES (23, 21, 48, 5);
INSERT INTO Quantite
VALUES (26, 22, 50, 11);
INSERT INTO Quantite
VALUES (8, 22, 32, 10);
INSERT INTO Quantite
VALUES (18, 22, 14, 3);
INSERT INTO Quantite
VALUES (16, 22, 26, 5);
INSERT INTO Quantite
VALUES (15, 22, 13, 4);
INSERT INTO Quantite
VALUES (13, 23, 8, 8);
INSERT INTO Quantite
VALUES (19, 23, 44, 11);
INSERT INTO Quantite
VALUES (28, 23, 47, 6);
INSERT INTO Quantite
VALUES (15, 23, 23, 10);
INSERT INTO Quantite
VALUES (3, 23, 5, 5);
INSERT INTO Quantite
VALUES (12, 24, 41, 5);
INSERT INTO Quantite
VALUES (2, 24, 43, 7);
INSERT INTO Quantite
VALUES (5, 24, 36, 8);
INSERT INTO Quantite
VALUES (24, 24, 37, 1);
INSERT INTO Quantite
VALUES (28, 24, 7, 2);
INSERT INTO Quantite
VALUES (1, 25, 28, 1);
INSERT INTO Quantite
VALUES (18, 25, 30, 7);
INSERT INTO Quantite
VALUES (14, 25, 41, 6);
INSERT INTO Quantite
VALUES (8, 25, 7, 5);
INSERT INTO Quantite
VALUES (10, 25, 23, 2);
INSERT INTO Quantite
VALUES (22, 26, 33, 4);
INSERT INTO Quantite
VALUES (21, 26, 31, 2);
INSERT INTO Quantite
VALUES (1, 26, 46, 8);
INSERT INTO Quantite
VALUES (8, 26, 5, 3);
INSERT INTO Quantite
VALUES (20, 26, 40, 6);
INSERT INTO Quantite
VALUES (13, 27, 39, 12);
INSERT INTO Quantite
VALUES (26, 27, 42, 6);
INSERT INTO Quantite
VALUES (7, 27, 9, 11);
INSERT INTO Quantite
VALUES (8, 27, 33, 4);
INSERT INTO Quantite
VALUES (25, 27, 3, 6);
INSERT INTO Quantite
VALUES (24, 28, 37, 4);
INSERT INTO Quantite
VALUES (28, 28, 37, 3);
INSERT INTO Quantite
VALUES (4, 28, 22, 6);
INSERT INTO Quantite
VALUES (9, 28, 34, 6);
INSERT INTO Quantite
VALUES (8, 28, 16, 9);
INSERT INTO Quantite
VALUES (19, 29, 43, 8);
INSERT INTO Quantite
VALUES (16, 29, 6, 11);
INSERT INTO Quantite
VALUES (22, 29, 40, 2);
INSERT INTO Quantite
VALUES (8, 29, 22, 5);
INSERT INTO Quantite
VALUES (8, 37, 47, 7);
INSERT INTO Quantite
VALUES (21, 30, 9, 7);
INSERT INTO Quantite
VALUES (10, 30, 32, 10);
INSERT INTO Quantite
VALUES (17, 30, 28, 12);
INSERT INTO Quantite
VALUES (18, 30, 26, 10);
INSERT INTO Quantite
VALUES (27, 30, 26, 5);
INSERT INTO Quantite
VALUES (2, 31, 34, 2);
INSERT INTO Quantite
VALUES (5, 31, 36, 1);
INSERT INTO Quantite
VALUES (14, 31, 27, 2);
INSERT INTO Quantite
VALUES (6, 31, 9, 10);
INSERT INTO Quantite
VALUES (25, 31, 47, 9);
INSERT INTO Quantite
VALUES (22, 32, 11, 12);
INSERT INTO Quantite
VALUES (3, 32, 12, 12);
INSERT INTO Quantite
VALUES (26, 32, 15, 4);
INSERT INTO Quantite
VALUES (10, 32, 45, 7);
INSERT INTO Quantite
VALUES (2, 32, 36, 12);
INSERT INTO Quantite
VALUES (3, 33, 32, 6);
INSERT INTO Quantite
VALUES (3, 13, 11, 2);
INSERT INTO Quantite
VALUES (24, 33, 28, 2);
INSERT INTO Quantite
VALUES (26, 33, 10, 2);
INSERT INTO Quantite
VALUES (16, 33, 30, 8);
INSERT INTO Quantite
VALUES (25, 34, 34, 4);
INSERT INTO Quantite
VALUES (12, 34, 19, 6);
INSERT INTO Quantite
VALUES (5, 34, 36, 2);
INSERT INTO Quantite
VALUES (15, 34, 22, 9);
INSERT INTO Quantite
VALUES (18, 34, 42, 7);
INSERT INTO Quantite
VALUES (19, 35, 48, 2);
INSERT INTO Quantite
VALUES (18, 35, 42, 2);
INSERT INTO Quantite
VALUES (1, 35, 38, 8);
INSERT INTO Quantite
VALUES (6, 35, 42, 8);
INSERT INTO Quantite
VALUES (16, 35, 12, 10);
INSERT INTO Quantite
VALUES (3, 36, 4, 4);
INSERT INTO Quantite
VALUES (8, 36, 20, 5);
INSERT INTO Quantite
VALUES (20, 36, 19, 12);
INSERT INTO Quantite
VALUES (9, 36, 47, 9);
INSERT INTO Quantite
VALUES (3, 39, 18, 6);
INSERT INTO Quantite
VALUES (23, 37, 22, 7);
INSERT INTO Quantite
VALUES (14, 37, 8, 4);
INSERT INTO Quantite
VALUES (21, 37, 12, 5);
INSERT INTO Quantite
VALUES (21, 99, 20, 5);
INSERT INTO Quantite
VALUES (2, 37, 39, 6);
INSERT INTO Quantite
VALUES (27, 38, 19, 12);
INSERT INTO Quantite
VALUES (13, 38, 41, 4);
INSERT INTO Quantite
VALUES (25, 38, 31, 5);
INSERT INTO Quantite
VALUES (7, 38, 35, 8);
INSERT INTO Quantite
VALUES (22, 38, 37, 4);
INSERT INTO Quantite
VALUES (20, 39, 35, 10);
INSERT INTO Quantite
VALUES (27, 39, 9, 3);
INSERT INTO Quantite
VALUES (21, 39, 16, 6);
INSERT INTO Quantite
VALUES (4, 39, 42, 9);
INSERT INTO Quantite
VALUES (15, 39, 46, 2);
INSERT INTO Quantite
VALUES (6, 40, 24, 9);
INSERT INTO Quantite
VALUES (23, 40, 32, 5);
INSERT INTO Quantite
VALUES (16, 40, 12, 7);
INSERT INTO Quantite
VALUES (3, 40, 21, 12);
INSERT INTO Quantite
VALUES (4, 40, 41, 6);
INSERT INTO Quantite
VALUES (3, 41, 15, 8);
INSERT INTO Quantite
VALUES (19, 41, 34, 6);
INSERT INTO Quantite
VALUES (9, 41, 35, 7);
INSERT INTO Quantite
VALUES (13, 41, 17, 3);
INSERT INTO Quantite
VALUES (23, 41, 13, 8);
INSERT INTO Quantite
VALUES (13, 42, 11, 9);
INSERT INTO Quantite
VALUES (21, 42, 18, 6);
INSERT INTO Quantite
VALUES (21, 84, 4, 11);
INSERT INTO Quantite
VALUES (4, 42, 36, 6);
INSERT INTO Quantite
VALUES (24, 42, 45, 9);
INSERT INTO Quantite
VALUES (3, 43, 36, 3);
INSERT INTO Quantite
VALUES (13, 43, 37, 8);
INSERT INTO Quantite
VALUES (25, 43, 41, 12);
INSERT INTO Quantite
VALUES (28, 43, 19, 11);
INSERT INTO Quantite
VALUES (6, 43, 12, 11);
INSERT INTO Quantite
VALUES (14, 44, 37, 1);
INSERT INTO Quantite
VALUES (12, 44, 21, 2);
INSERT INTO Quantite
VALUES (26, 44, 50, 5);
INSERT INTO Quantite
VALUES (15, 44, 27, 6);
INSERT INTO Quantite
VALUES (11, 44, 12, 2);
INSERT INTO Quantite
VALUES (16, 45, 49, 6);
INSERT INTO Quantite
VALUES (22, 45, 48, 2);
INSERT INTO Quantite
VALUES (2, 45, 44, 3);
INSERT INTO Quantite
VALUES (9, 45, 21, 9);
INSERT INTO Quantite
VALUES (10, 45, 39, 2);
INSERT INTO Quantite
VALUES (18, 46, 9, 2);
INSERT INTO Quantite
VALUES (23, 46, 41, 10);
INSERT INTO Quantite
VALUES (5, 46, 48, 8);
INSERT INTO Quantite
VALUES (14, 46, 36, 10);
INSERT INTO Quantite
VALUES (8, 46, 26, 2);
INSERT INTO Quantite
VALUES (6, 47, 50, 3);
INSERT INTO Quantite
VALUES (1, 47, 31, 6);
INSERT INTO Quantite
VALUES (25, 47, 35, 7);
INSERT INTO Quantite
VALUES (27, 47, 14, 1);
INSERT INTO Quantite
VALUES (8, 47, 37, 10);
INSERT INTO Quantite
VALUES (17, 48, 28, 10);
INSERT INTO Quantite
VALUES (2, 48, 40, 5);
INSERT INTO Quantite
VALUES (22, 48, 46, 8);
INSERT INTO Quantite
VALUES (3, 48, 30, 2);
INSERT INTO Quantite
VALUES (16, 48, 22, 8);
INSERT INTO Quantite
VALUES (11, 49, 22, 2);
INSERT INTO Quantite
VALUES (8, 49, 46, 5);
INSERT INTO Quantite
VALUES (12, 49, 44, 5);
INSERT INTO Quantite
VALUES (24, 49, 40, 4);
INSERT INTO Quantite
VALUES (19, 49, 20, 4);
INSERT INTO Quantite
VALUES (19, 50, 36, 4);
INSERT INTO Quantite
VALUES (11, 50, 35, 5);
INSERT INTO Quantite
VALUES (9, 50, 5, 2);
INSERT INTO Quantite
VALUES (10, 50, 25, 6);
INSERT INTO Quantite
VALUES (3, 50, 20, 5);
INSERT INTO Quantite
VALUES (16, 51, 17, 8);
INSERT INTO Quantite
VALUES (25, 51, 20, 28);
INSERT INTO Quantite
VALUES (11, 51, 24, 23);
INSERT INTO Quantite
VALUES (22, 51, 26, 17);
INSERT INTO Quantite
VALUES (9, 51, 9, 16);
INSERT INTO Quantite
VALUES (22, 52, 49, 21);
INSERT INTO Quantite
VALUES (9, 52, 6, 8);
INSERT INTO Quantite
VALUES (22, 62, 13, 12);
INSERT INTO Quantite
VALUES (20, 52, 27, 19);
INSERT INTO Quantite
VALUES (16, 52, 36, 10);
INSERT INTO Quantite
VALUES (3, 53, 8, 26);
INSERT INTO Quantite
VALUES (25, 53, 19, 9);
INSERT INTO Quantite
VALUES (17, 53, 29, 10);
INSERT INTO Quantite
VALUES (9, 53, 3, 14);
INSERT INTO Quantite
VALUES (11, 53, 17, 18);
INSERT INTO Quantite
VALUES (25, 54, 21, 15);
INSERT INTO Quantite
VALUES (15, 54, 6, 15);
INSERT INTO Quantite
VALUES (22, 54, 36, 18);
INSERT INTO Quantite
VALUES (9, 54, 13, 13);
INSERT INTO Quantite
VALUES (16, 54, 9, 29);
INSERT INTO Quantite
VALUES (9, 55, 41, 7);
INSERT INTO Quantite
VALUES (8, 55, 42, 22);
INSERT INTO Quantite
VALUES (14, 55, 35, 25);
INSERT INTO Quantite
VALUES (15, 55, 14, 29);
INSERT INTO Quantite
VALUES (14, 85, 36, 6);
INSERT INTO Quantite
VALUES (8, 56, 10, 6);
INSERT INTO Quantite
VALUES (16, 56, 38, 7);
INSERT INTO Quantite
VALUES (9, 56, 6, 27);
INSERT INTO Quantite
VALUES (22, 56, 23, 19);
INSERT INTO Quantite
VALUES (11, 56, 9, 13);
INSERT INTO Quantite
VALUES (22, 57, 31, 26);
INSERT INTO Quantite
VALUES (13, 57, 14, 21);
INSERT INTO Quantite
VALUES (25, 57, 44, 8);
INSERT INTO Quantite
VALUES (23, 57, 40, 15);
INSERT INTO Quantite
VALUES (24, 57, 33, 19);
INSERT INTO Quantite
VALUES (16, 58, 24, 30);
INSERT INTO Quantite
VALUES (11, 58, 33, 25);
INSERT INTO Quantite
VALUES (9, 58, 40, 15);
INSERT INTO Quantite
VALUES (24, 58, 31, 18);
INSERT INTO Quantite
VALUES (14, 58, 7, 15);
INSERT INTO Quantite
VALUES (16, 59, 46, 26);
INSERT INTO Quantite
VALUES (15, 59, 39, 22);
INSERT INTO Quantite
VALUES (11, 59, 23, 13);
INSERT INTO Quantite
VALUES (11, 89, 28, 9);
INSERT INTO Quantite
VALUES (24, 59, 6, 29);
INSERT INTO Quantite
VALUES (22, 60, 11, 8);
INSERT INTO Quantite
VALUES (20, 60, 49, 29);
INSERT INTO Quantite
VALUES (21, 60, 10, 19);
INSERT INTO Quantite
VALUES (22, 30, 34, 10);
INSERT INTO Quantite
VALUES (16, 60, 22, 6);
INSERT INTO Quantite
VALUES (22, 61, 45, 23);
INSERT INTO Quantite
VALUES (14, 61, 37, 11);
INSERT INTO Quantite
VALUES (8, 61, 30, 16);
INSERT INTO Quantite
VALUES (15, 61, 17, 14);
INSERT INTO Quantite
VALUES (16, 61, 21, 12);
INSERT INTO Quantite
VALUES (20, 62, 25, 7);
INSERT INTO Quantite
VALUES (25, 62, 24, 21);
INSERT INTO Quantite
VALUES (3, 62, 26, 13);
INSERT INTO Quantite
VALUES (15, 62, 38, 22);
INSERT INTO Quantite
VALUES (3, 72, 13, 21);
INSERT INTO Quantite
VALUES (16, 63, 6, 25);
INSERT INTO Quantite
VALUES (20, 63, 48, 17);
INSERT INTO Quantite
VALUES (20, 83, 40, 16);
INSERT INTO Quantite
VALUES (9, 63, 5, 10);
INSERT INTO Quantite
VALUES (16, 93, 42, 14);
INSERT INTO Quantite
VALUES (17, 64, 10, 26);
INSERT INTO Quantite
VALUES (9, 64, 49, 9);
INSERT INTO Quantite
VALUES (25, 64, 7, 14);
INSERT INTO Quantite
VALUES (20, 64, 21, 9);
INSERT INTO Quantite
VALUES (14, 64, 48, 16);
INSERT INTO Quantite
VALUES (11, 65, 7, 14);
INSERT INTO Quantite
VALUES (22, 65, 24, 9);
INSERT INTO Quantite
VALUES (8, 65, 7, 11);
INSERT INTO Quantite
VALUES (1, 65, 47, 12);
INSERT INTO Quantite
VALUES (25, 65, 41, 20);
INSERT INTO Quantite
VALUES (9, 66, 20, 15);
INSERT INTO Quantite
VALUES (24, 66, 46, 18);
INSERT INTO Quantite
VALUES (19, 66, 48, 5);
INSERT INTO Quantite
VALUES (11, 66, 18, 28);
INSERT INTO Quantite
VALUES (18, 66, 45, 29);
INSERT INTO Quantite
VALUES (14, 67, 13, 21);
INSERT INTO Quantite
VALUES (22, 67, 47, 19);
INSERT INTO Quantite
VALUES (24, 67, 44, 22);
INSERT INTO Quantite
VALUES (9, 67, 26, 7);
INSERT INTO Quantite
VALUES (4, 67, 44, 19);
INSERT INTO Quantite
VALUES (25, 68, 49, 20);
INSERT INTO Quantite
VALUES (13, 68, 27, 9);
INSERT INTO Quantite
VALUES (11, 68, 30, 18);
INSERT INTO Quantite
VALUES (25, 28, 43, 17);
INSERT INTO Quantite
VALUES (24, 68, 34, 16);
INSERT INTO Quantite
VALUES (9, 69, 5, 12);
INSERT INTO Quantite
VALUES (27, 79, 32, 10);
INSERT INTO Quantite
VALUES (25, 69, 35, 14);
INSERT INTO Quantite
VALUES (14, 69, 15, 27);
INSERT INTO Quantite
VALUES (22, 69, 8, 18);
INSERT INTO Quantite
VALUES (25, 70, 47, 10);
INSERT INTO Quantite
VALUES (16, 70, 11, 20);
INSERT INTO Quantite
VALUES (16, 75, 22, 23);
INSERT INTO Quantite
VALUES (14, 70, 13, 29);
INSERT INTO Quantite
VALUES (14, 50, 31, 13);
INSERT INTO Quantite
VALUES (9, 71, 23, 17);
INSERT INTO Quantite
VALUES (20, 71, 6, 12);
INSERT INTO Quantite
VALUES (15, 71, 6, 26);
INSERT INTO Quantite
VALUES (20, 21, 6, 19);
INSERT INTO Quantite
VALUES (7, 71, 26, 11);
INSERT INTO Quantite
VALUES (22, 72, 39, 22);
INSERT INTO Quantite
VALUES (24, 72, 36, 15);
INSERT INTO Quantite
VALUES (16, 72, 31, 7);
INSERT INTO Quantite
VALUES (17, 72, 42, 13);
INSERT INTO Quantite
VALUES (11, 72, 20, 22);
INSERT INTO Quantite
VALUES (8, 73, 20, 11);
INSERT INTO Quantite
VALUES (11, 73, 37, 15);
INSERT INTO Quantite
VALUES (13, 73, 26, 15);
INSERT INTO Quantite
VALUES (15, 73, 35, 10);
INSERT INTO Quantite
VALUES (22, 73, 33, 14);
INSERT INTO Quantite
VALUES (20, 74, 5, 12);
INSERT INTO Quantite
VALUES (25, 74, 13, 28);
INSERT INTO Quantite
VALUES (14, 74, 15, 23);
INSERT INTO Quantite
VALUES (16, 74, 6, 7);
INSERT INTO Quantite
VALUES (25, 37, 15, 14);
INSERT INTO Quantite
VALUES (25, 75, 29, 25);
INSERT INTO Quantite
VALUES (14, 75, 15, 7);
INSERT INTO Quantite
VALUES (9, 75, 32, 11);
INSERT INTO Quantite
VALUES (20, 75, 39, 28);
INSERT INTO Quantite
VALUES (6, 75, 37, 8);
INSERT INTO Quantite
VALUES (22, 76, 16, 9);
INSERT INTO Quantite
VALUES (9, 76, 34, 10);
INSERT INTO Quantite
VALUES (4, 76, 23, 28);
INSERT INTO Quantite
VALUES (24, 87, 42, 25);
INSERT INTO Quantite
VALUES (11, 76, 17, 11);
INSERT INTO Quantite
VALUES (24, 77, 10, 7);
INSERT INTO Quantite
VALUES (16, 77, 35, 20);
INSERT INTO Quantite
VALUES (25, 77, 24, 25);
INSERT INTO Quantite
VALUES (8, 77, 45, 11);
INSERT INTO Quantite
VALUES (19, 47, 39, 19);
INSERT INTO Quantite
VALUES (14, 78, 19, 6);
INSERT INTO Quantite
VALUES (25, 78, 4, 10);
INSERT INTO Quantite
VALUES (24, 78, 44, 19);
INSERT INTO Quantite
VALUES (20, 78, 14, 12);
INSERT INTO Quantite
VALUES (9, 78, 4, 5);
INSERT INTO Quantite
VALUES (15, 79, 18, 28);
INSERT INTO Quantite
VALUES (16, 79, 49, 20);
INSERT INTO Quantite
VALUES (14, 79, 47, 18);
INSERT INTO Quantite
VALUES (9, 79, 11, 21);
INSERT INTO Quantite
VALUES (22, 79, 13, 30);
INSERT INTO Quantite
VALUES (25, 80, 11, 20);
INSERT INTO Quantite
VALUES (14, 80, 14, 18);
INSERT INTO Quantite
VALUES (20, 80, 5, 20);
INSERT INTO Quantite
VALUES (9, 80, 11, 18);
INSERT INTO Quantite
VALUES (22, 80, 11, 14);
INSERT INTO Quantite
VALUES (20, 81, 37, 26);
INSERT INTO Quantite
VALUES (25, 81, 40, 12);
INSERT INTO Quantite
VALUES (14, 81, 20, 21);
INSERT INTO Quantite
VALUES (9, 81, 43, 27);
INSERT INTO Quantite
VALUES (15, 81, 44, 12);
INSERT INTO Quantite
VALUES (9, 82, 40, 18);
INSERT INTO Quantite
VALUES (16, 82, 46, 17);
INSERT INTO Quantite
VALUES (20, 82, 33, 29);
INSERT INTO Quantite
VALUES (8, 82, 9, 19);
INSERT INTO Quantite
VALUES (17, 82, 5, 7);
INSERT INTO Quantite
VALUES (22, 83, 40, 10);
INSERT INTO Quantite
VALUES (15, 83, 25, 13);
INSERT INTO Quantite
VALUES (8, 83, 12, 10);
INSERT INTO Quantite
VALUES (9, 83, 36, 28);
INSERT INTO Quantite
VALUES (21, 83, 16, 16);
INSERT INTO Quantite
VALUES (14, 84, 32, 24);
INSERT INTO Quantite
VALUES (25, 84, 41, 13);
INSERT INTO Quantite
VALUES (5, 84, 11, 14);
INSERT INTO Quantite
VALUES (22, 84, 18, 15);
INSERT INTO Quantite
VALUES (15, 84, 32, 12);
INSERT INTO Quantite
VALUES (8, 85, 44, 9);
INSERT INTO Quantite
VALUES (20, 85, 8, 6);
INSERT INTO Quantite
VALUES (20, 55, 15, 9);
INSERT INTO Quantite
VALUES (16, 85, 26, 18);
INSERT INTO Quantite
VALUES (9, 85, 34, 9);
INSERT INTO Quantite
VALUES (24, 86, 46, 8);
INSERT INTO Quantite
VALUES (15, 86, 16, 8);
INSERT INTO Quantite
VALUES (11, 86, 34, 21);
INSERT INTO Quantite
VALUES (3, 86, 36, 15);
INSERT INTO Quantite
VALUES (9, 86, 27, 13);
INSERT INTO Quantite
VALUES (20, 87, 39, 6);
INSERT INTO Quantite
VALUES (9, 87, 31, 9);
INSERT INTO Quantite
VALUES (25, 87, 5, 16);
INSERT INTO Quantite
VALUES (21, 87, 20, 25);
INSERT INTO Quantite
VALUES (22, 87, 29, 24);
INSERT INTO Quantite
VALUES (20, 88, 49, 27);
INSERT INTO Quantite
VALUES (17, 88, 16, 20);
INSERT INTO Quantite
VALUES (11, 88, 6, 20);
INSERT INTO Quantite
VALUES (25, 88, 40, 16);
INSERT INTO Quantite
VALUES (25, 63, 43, 15);
INSERT INTO Quantite
VALUES (13, 89, 14, 22);
INSERT INTO Quantite
VALUES (3, 89, 37, 25);
INSERT INTO Quantite
VALUES (16, 89, 28, 24);
INSERT INTO Quantite
VALUES (17, 89, 13, 21);
INSERT INTO Quantite
VALUES (20, 89, 47, 10);
INSERT INTO Quantite
VALUES (16, 90, 3, 22);
INSERT INTO Quantite
VALUES (16, 65, 17, 5);
INSERT INTO Quantite
VALUES (20, 90, 29, 17);
INSERT INTO Quantite
VALUES (9, 90, 19, 10);
INSERT INTO Quantite
VALUES (25, 90, 13, 11);
INSERT INTO Quantite
VALUES (20, 91, 24, 14);
INSERT INTO Quantite
VALUES (25, 91, 15, 27);
INSERT INTO Quantite
VALUES (20, 23, 28, 27);
INSERT INTO Quantite
VALUES (25, 71, 39, 24);
INSERT INTO Quantite
VALUES (16, 91, 37, 7);
INSERT INTO Quantite
VALUES (17, 92, 38, 6);
INSERT INTO Quantite
VALUES (15, 92, 29, 8);
INSERT INTO Quantite
VALUES (18, 92, 17, 14);
INSERT INTO Quantite
VALUES (27, 92, 40, 3);
INSERT INTO Quantite
VALUES (25, 92, 27, 8);
INSERT INTO Quantite
VALUES (6, 93, 11, 16);
INSERT INTO Quantite
VALUES (23, 93, 23, 16);
INSERT INTO Quantite
VALUES (11, 93, 50, 5);
INSERT INTO Quantite
VALUES (9, 93, 37, 5);
INSERT INTO Quantite
VALUES (20, 93, 49, 5);
INSERT INTO Quantite
VALUES (6, 94, 25, 17);
INSERT INTO Quantite
VALUES (20, 94, 26, 13);
INSERT INTO Quantite
VALUES (21, 94, 9, 2);
INSERT INTO Quantite
VALUES (1, 94, 41, 18);
INSERT INTO Quantite
VALUES (23, 94, 34, 7);
INSERT INTO Quantite
VALUES (11, 95, 6, 17);
INSERT INTO Quantite
VALUES (5, 95, 42, 19);
INSERT INTO Quantite
VALUES (20, 95, 15, 9);
INSERT INTO Quantite
VALUES (21, 95, 38, 10);
INSERT INTO Quantite
VALUES (15, 95, 21, 16);
INSERT INTO Quantite
VALUES (20, 96, 14, 2);
INSERT INTO Quantite
VALUES (25, 96, 11, 9);
INSERT INTO Quantite
VALUES (16, 96, 16, 8);
INSERT INTO Quantite
VALUES (15, 96, 20, 14);
INSERT INTO Quantite
VALUES (28, 96, 31, 8);
INSERT INTO Quantite
VALUES (16, 97, 30, 3);
INSERT INTO Quantite
VALUES (9, 97, 39, 12);
INSERT INTO Quantite
VALUES (13, 97, 42, 13);
INSERT INTO Quantite
VALUES (26, 97, 42, 8);
INSERT INTO Quantite
VALUES (11, 97, 35, 4);
INSERT INTO Quantite
VALUES (20, 98, 9, 11);
INSERT INTO Quantite
VALUES (6, 98, 41, 4);
INSERT INTO Quantite
VALUES (28, 98, 32, 3);
INSERT INTO Quantite
VALUES (12, 98, 38, 8);
INSERT INTO Quantite
VALUES (8, 98, 16, 7);
INSERT INTO Quantite
VALUES (9, 99, 17, 9);
INSERT INTO Quantite
VALUES (3, 99, 46, 17);
INSERT INTO Quantite
VALUES (23, 99, 25, 7);
INSERT INTO Quantite
VALUES (26, 99, 13, 8);
INSERT INTO Quantite
VALUES (19, 99, 48, 4);
INSERT INTO Quantite
VALUES (18, 100, 36, 12);
INSERT INTO Quantite
VALUES (24, 100, 20, 12);
INSERT INTO Quantite
VALUES (15, 100, 35, 19);
INSERT INTO Quantite
VALUES (28, 100, 4, 16);
INSERT INTO Quantite
VALUES (21, 100, 44, 7);
