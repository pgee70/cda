<?php

/**
 * The MIT License
 *
 * Copyright 2016 Julien Fastré <julien.fastre@champs-libres.coop>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace i3Soft\CDA;

use i3Soft\CDA\DataType\Identifier\InstanceIdentifier;
use i3Soft\CDA\Elements\TypeId;
use i3Soft\CDA\Helper\ReferenceManager;
use i3Soft\CDA\Interfaces\ClassCodeInterface;
use i3Soft\CDA\Interfaces\MoodCodeInterface;
use i3Soft\CDA\Traits\AuthenticatorTrait;
use i3Soft\CDA\Traits\AuthorizationTrait;
use i3Soft\CDA\Traits\AuthorsTrait;
use i3Soft\CDA\Traits\ClassCodeTrait;
use i3Soft\CDA\Traits\CodeTrait;
use i3Soft\CDA\Traits\CompletionCodeTrait;
use i3Soft\CDA\Traits\ConfidentialityCodeTrait;
use i3Soft\CDA\Traits\CopyTimeTrait;
use i3Soft\CDA\Traits\CustodianTrait;
use i3Soft\CDA\Traits\DataEntererTrait;
use i3Soft\CDA\Traits\DocumentationOfsTrait;
use i3Soft\CDA\Traits\EffectiveTimeTrait;
use i3Soft\CDA\Traits\IdTrait;
use i3Soft\CDA\Traits\InformantsTrait;
use i3Soft\CDA\Traits\InformationRecipientsTrait;
use i3Soft\CDA\Traits\LanguageCodeTrait;
use i3Soft\CDA\Traits\LegalAuthenticatorTrait;
use i3Soft\CDA\Traits\MoodCodeTrait;
use i3Soft\CDA\Traits\ParticipantsTrait;
use i3Soft\CDA\Traits\RealmCodesTrait;
use i3Soft\CDA\Traits\RecordTargetsTrait;
use i3Soft\CDA\Traits\SetIdTrait;
use i3Soft\CDA\Traits\TemplateIdsTrait;
use i3Soft\CDA\Traits\TitleTrait;
use i3Soft\CDA\Traits\TypeIdTrait;
use i3Soft\CDA\Traits\VersionNumberTrait;

/**
 * Root class for clinical document
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 * @author Peter Gee <https://github.com/pgee70>
 */
class ClinicalDocument implements ClassCodeInterface, MoodCodeInterface
{
    const NS_CDA     = '';
    const NS_CDA_URI = 'urn:hl7-org:v3';
    const NS_XSI_URI = 'http://www.w3.org/2001/XMLSchema-instance';
    const VERSION = '1.0.3';

    use RealmCodesTrait;
    use TypeIdTrait;
    use TemplateIdsTrait;
    use IdTrait;
    use CodeTrait;
    use TitleTrait;
    use EffectiveTimeTrait;
    use ConfidentialityCodeTrait;
    use LanguageCodeTrait;
    use SetIdTrait;
    use VersionNumberTrait;
    use CompletionCodeTrait;
    use CopyTimeTrait;
    use RecordTargetsTrait;
    use AuthorsTrait;
    use DataEntererTrait;
    use InformantsTrait;
    use CustodianTrait;
    use InformationRecipientsTrait;
    use legalAuthenticatorTrait;
    use AuthenticatorTrait;
    use ParticipantsTrait;
    // use InFulfillmentOfsTrait;
    use DocumentationOfsTrait;
    // use RelatedDocumentsTrait;
    use AuthorizationTrait;

    // use ComponentOfTrait;
    // use ComponentTrait;
    use ClassCodeTrait;
    use MoodCodeTrait;

    /**
     * Refeger assigned to this document  *
     *
     * @var ReferenceManager
     */
    private $referenceManager;
    /**
     * the root component
     *
     * @var Component\RootBodyComponent
     */
    private $rootComponent;
    private $informationRecipient;
    private $inFulfillmentOf;
    private $documentationOf;
    private $relatedDocument;

    /**
     * ClinicalDocument constructor.
     */
    public function __construct()
    {
        $this->rootComponent    = new Component\RootBodyComponent();
        $this->referenceManager = new ReferenceManager();
        $this->setTypeId(new TypeId(new InstanceIdentifier('2.16.840.1.113883.1.3', 'POCD_HD000040')))
          ->setAcceptableClassCodes(['', ClassCodeInterface::CLINICAL_DOCUMENT])
          ->setClassCode('')
          ->setAcceptableMoodCodes(['', MoodCodeInterface::EVENT])
          ->setMoodCode('');
    }

    /**
     *
     * @return ReferenceManager
     */
    public function getReferenceManager(): ReferenceManager
    {
        return $this->referenceManager;
    }


    /**
     *
     * @param \DOMDocument|null $doc
     *
     * @return \DOMDocument
     */
    public function toDOMDocument(\DOMDocument $doc = null): \DOMDocument
    {
        $doc = $doc ?? new \DOMDocument('1.0', 'UTF-8');
        $el  = $doc->createElementNS(self::NS_CDA_URI, 'ClinicalDocument');
        $doc->appendChild($el);
        // set the NS
        $el->setAttributeNS(
          self::NS_XSI_URI,
          'xsi:schemaLocation',
          'CDA-ES-v1_3.xsd'
        );
        $el->setAttribute('xmlns:ext', 'http://ns.electronichealth.net.au/Ci/Cda/Extensions/3.0');
        $el->setAttribute('xmlns:xs', 'http://www.w3.org/2001/XMLSchema');
        if ($this->hasClassCode()) {
            $el->setAttribute('classCode', $this->getClassCode());
        }
        if ($this->hasMoodCode()) {
            $el->setAttribute('moodCode', $this->getMoodCode());
        }
        $this->renderRealmCodes($el, $doc)
          ->renderTypeId($el, $doc)
          ->renderTemplateIds($el, $doc)
          ->renderId($el, $doc)
          ->renderCode($el, $doc)
          ->renderTitle($el, $doc)
          ->renderEffectiveTime($el, $doc)
          ->renderConfidentialityCode($el, $doc)
          ->renderLanguageCode($el, $doc)
          ->renderSetId($el, $doc)
          ->renderVersionNumber($el, $doc)
          ->renderCopyTime($el, $doc)
          ->renderCompletionCode($el, $doc)
          ->renderRecordTargets($el, $doc)
          ->renderAuthors($el, $doc)
          ->renderDataEnter($el, $doc)
          ->renderInformants($el, $doc)
          ->renderCustodian($el, $doc)
          ->renderInformationRecipients($el, $doc)
          ->renderLegalAuthenticator($el, $doc)
          ->renderAuthenticator($el, $doc)
          ->renderParticipants($el, $doc)
          // todo inFulfillmentOf
          ->renderDocumentationOfs($el, $doc)
          // todo relatedDocument
          ->renderAuthorization($el, $doc);
        // todo componentOf
        // add components
        if (false === $this->getRootComponent()->isEmpty()) {
            $el->appendChild($this->getRootComponent()->toDOMElement($doc));
        }
        return $doc;
    }

    /**
     *
     * @return Component\RootBodyComponent
     */
    public function getRootComponent(): Component\RootBodyComponent
    {
        return $this->rootComponent;
    }

}
