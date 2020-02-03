

select U.Image Image, U.Nom Nom, U.Prenom Prenom
from utilisateur U
JOIN traducteurdata TD
ON U.Id = TD.TraducteurId
WHERE TD.Assermetation_doc is NULL;



select U.id, L.Nom
from utilisateur U
JOIN maitriselangue ML
ON U.Id = ML.TraducteurId
JOIN langue L
ON L.Id = ML.LangueId;



select U.id, MT.Type
from utilisateur U
JOIN maitrisetype MT
ON U.Id = MT.TraducteurId;



    select U.id, 
    CASE
    when AVG(N.valeur) is NULL then 0
    when AVG(N.valeur) is not null then AVG(N.valeur)
    END as note
    from utilisateur U
    LEfT Join note N
    On U.Id = N.TraducteurId
    group by u.Id;



select u.id, COUNT(tf.Id) nbr
from utilisateur u
LEFT join demandet_accepte da
on u.Id = da.TraducteurId
left join traduction_debutee td
on td.DemandeId = da.Id
left join traduction_finie tf
on tf.TraductionId = td.Id
group by u.id;

