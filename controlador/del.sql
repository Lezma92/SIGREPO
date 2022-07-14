DELIMITER Kiu
CREATE PROCEDURE actualizarAlumno(IN idDatos INT(11),IN idUsuario INT(11),IN idAlumno INT(11), 
IN mat INT(11),nom VARCHAR(35),IN app VARCHAR(35),IN grup VARCHAR(15), IN nivelEstudio VARCHAR(15),IN pass VARCHAR(35),IN nivel VARCHAR(35))
BEGIN
UPDATE datos_personales 
SET 
    matricula = mat,
    nombre = nom,
    apellidos = app
WHERE
    id = idDatos;
UPDATE alumnos 
SET 
    grupo = grup,
    nivel_estudio = nivelEstudio,
    pswrd = pass
WHERE
    id = idAlumno;
UPDATE usuarios 
SET 
    nick = mat,
    pswrd = pass,
    nivel_user = nivel
WHERE
    id = idUsuario;
END Kiu