<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20261122230000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Crea la nota vigente e importa la última nota escrita a mano.';
    }

    public function up(Schema $schema): void
    {
        $tabla = new Table('nota_vigente');
        $tabla->addColumn('id', Types::INTEGER);
        $tabla->addColumn('entrada_id', Types::INTEGER, ['notnull' => false]);
        $tabla->addColumn('titulo', Types::STRING, ['length' => 255, 'notnull' => false]);
        $tabla->addColumn('contenido', Types::TEXT);
        $tabla->setPrimaryKey(['id']);
        $tabla->addForeignKeyConstraint('entrada', ['entrada_id'], ['id'], ['onDelete' => 'SET NULL']);

        foreach ($this->connection->getDatabasePlatform()->getCreateTablesSQL([$tabla]) as $sql) {
            $this->addSql($sql);
        }
        $this->addSql('INSERT INTO nota_vigente (id, contenido) VALUES (1, ?)', [$this->notaManual()]);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE nota_vigente');
    }

    private function notaManual(): string
    {
        return <<<'HTML'
<div class="row mt-0">
    <div class="col-sm-12 col-md-10 col-lg-10 px-0 mx-auto mt-0">
        <div class="card mt-0 mb-1 py-2 px-3">
            <div class="col-sm-11 mx-auto mb-3">
                <div class="col-12 mx-auto text-center mb-0">

                    <h4 class="text-centrado text-600">
                        La espiral descendente de insatisfacción e inseguridad
                    </h4>

                    <p class="text-14-300 font-italic pl-4 text-centrado">
                        "Amo la ley de Dios con todo mi corazón, pero hay otro poder dentro de mí que está
                        <u>en guerra con mi mente</u>. Ese poder me esclaviza"
                        <br/>
                        <small class="float-end">
                            Romanos 7:21-23 (NTV)
                        </small>
                    </p><br/>

                    <h5 class="text-izq text-600">
                        MENTIRA: Me sentiré mejor si {{uno}}
                    </h5>

                    <p class="text-14-300 font-italic pl-4 text-centrado">
                        “Hermanos, todo lo que es verdadero, todo lo honesto, todo lo justo, todo lo puro,
                        todo lo amable, todo lo que es de buen nombre; si hay virtud alguna, si alguna alabanza,
                        <u>en esto piensen</u>"
                        <br/>
                        <small class="float-end">
                            Filipenses 4:8 (RVR)
                        </small>
                    </p><br/>

                    <h5 class="text-izq text-600">
                        VERDAD: Solo me saciaré {{dos}}
                    </h5>

                    <p class="text-14-300 font-italic pl-4 text-centrado">
                        "Mi principal deseo y esperanza es… honrar a Cristo a través de mi vida, ... Porque para mí,
                        <u>vivir verdaderamente es vivir en Cristo</u> y morir sería una ganancia."
                        <br/>
                        <small class="float-end">
                            Filipenses 1:20-21 (PDT)
                        </small>
                    </p><br/>

                    <div class="row col-10 mx-auto">
                        <h4 class="text-centrado text-600">
                            ¿Qué hacer en la quietud?
                        </h4>

                        <h5 class="text-izq text-600">
                            1. Experimenta y conoce {{tres}}
                        </h5>
                        <p class="text-14-300 font-italic pl-4 text-centrado">
                            "«¡Quédense <u>quietos</u> y sepan que <u>yo soy Dios</u>!"
                            <br/>
                            <small class="float-end">
                                Salmos 46:10 (NTV)
                            </small>
                        </p><br/>
                        <p class="text-14-300 font-italic pl-4 text-centrado">
                            "¿No te das cuenta de lo bondadoso, tolerante y paciente que es Dios contigo?
                            ¿Acaso eso no significa nada para ti? ¿No ves que la bondad de Dios es para guiarte
                            a que <u>te arrepientas</u>...?"
                            <br/>
                            <small class="float-end">
                                Romanos 2:4 (NTV)
                            </small>
                        </p><br/>

                        <h5 class="text-izq text-600">
                            2. Lucha por la verdad con {{cuatro}}
                        </h5>
                        <p class="text-14-300 font-italic pl-4 text-centrado">
                            "Alaba, alma mía, al Señor; que todo mi ser alabe su santo nombre. Alaba, alma mía,
                            al Señor; y que no olvide mi ser las maravillosas cosas que él ha hecho por mí."
                            <br/>
                            <small class="float-end">
                                Salmos 103:1-2 (VBL)
                            </small>
                        </p><br/>
                        <p class="text-14-300 font-italic pl-4 text-centrado">
                            “Las enseñanzas del SEÑOR son perfectas, reavivan el alma… hacen sabio al sencillo…
                            traen alegría al corazón… dan buena percepción para vivir”
                            <br/>
                            <small class="float-end">
                                Salmos 19:7-8 (NTV)
                            </small>
                        </p><br/>
                        <p class="text-14-300 font-italic pl-4 text-centrado">
                            "¿Cómo puedo conocer todos los pecados <u>escondidos en mi corazón</u>? Límpiame de estas
                            faltas ocultas. ¡Libra a tu siervo de pecar intencionalmente! No permitas que estos
                            pecados me controlen"
                            <br/>
                            <small class="float-end">
                                Salmos 19:12-13a (NTV)
                            </small>
                        </p><br/>
                        <p class="text-14-300 font-italic pl-4 text-centrado">
                            "Pues la palabra de Dios es viva y poderosa. Es más cortante que cualquier espada de
                            dos filos; penetra entre el alma y el espíritu, entre la articulación y la médula del
                            hueso. Deja al descubierto nuestros <u>pensamientos</u> y deseos más íntimos."
                            <br/>
                            <small class="float-end">
                                Hebreos 4:12 (NTV)
                            </small>
                        </p><br/>

                        <h5 class="text-izq text-600">
                            3. Deja que Dios {{cinco}} por vos.
                        </h5>
                        <p class="text-14-300 font-italic pl-4 text-centrado">
                            "Ustedes quédense <u>quietos</u>, que el Señor presentará batalla por ustedes."
                            <br/>
                            <small class="float-end">
                                Éxodo 14:14 (NVI)
                            </small>
                        </p><br/>
                        <p class="text-14-300 font-italic pl-4 text-centrado">
                            "Dejen que <u>el Espíritu Santo los guíe</u> en la vida. Entonces no se dejarán llevar
                            por los impulsos de la naturaleza pecaminosa."
                            <br/>
                            <small class="float-end">
                                Gálatas 5:16 (NTV)
                            </small>
                        </p><br/>

                        <h5 class="text-izq text-600">
                            4. Elige a Dios como tu {{seis}}
                        </h5>
                        <p class="text-14-300 font-italic pl-4 text-centrado">
                            "En tu presencia hay plenitud de <u>gozo, Delicias</u> a tu diestra para siempre."
                            <br/>
                            <small class="float-end">
                                Salmos 16:11b (BXT)
                            </small>
                        </p><br/>
                        <p class="text-14-300 font-italic pl-4 text-centrado">
                            "Un solo día en tus atrios, ¡es mejor que mil en cualquier otro lugar!"
                            <br/>
                            <small class="float-end">
                                Salmos 84:10a (NTV)
                            </small>
                        </p><br/>
                        <p class="text-14-300 font-italic pl-4 text-centrado">
                            <br/>

                            "<u>Sólo en Dios</u> halla descanso mi alma; de él viene mi salvación."
                            <br/>
                            <small class="float-end">
                                Salmos 62:1 (NVI)
                            </small>
                        </p><br/>
                        <p class="text-14-300 font-italic pl-4 text-centrado">
                            "Resistan al diablo, y él huirá de ustedes.<br/>
                            <u>Acérquense a Dios, y Dios se acercará a ustedes.</u>"
                            <br/>
                            <small class="float-end">
                                Santiago 4:7-8 (NTV)
                            </small>
                        </p><br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
HTML;
    }
}
